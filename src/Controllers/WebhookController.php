<?php

namespace ByteFederal\ByteAuthLaravel\Controllers;


use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class WebhookController extends Controller
{
    public function handleRegistration(Request $request)
    {
        Log::debug('Registration Webhook received: ', $request->all());
    
        $receivedSid = $request->input('sid');
    
        // Check for a valid session ID
        if (!Cache::has('sid_' . $receivedSid)) {
            Log::debug('Invalid session ID detected on registration.', ['received_sid' => $receivedSid]);
            return response()->json(['message' => 'Invalid session ID'], 401);
        }
    
        $userData = $request->all();
        $name =  $userData['bytename'];
    
        // Perform user creation logic
        $user = User::firstOrCreate([
            'email' => $userData['email'],
        ], [
            'name' => $name,
            'password' => Hash::make(Str::random(16)), // Generate a random password
        ]);
    
        // Store the user's ID in the cache tied to the SID for further checks
        Cache::put('authenticated_sid_' . $receivedSid, $user->id, now()->addMinutes(10));
    }

    public function handleLogin(Request $request)
    {
        Log::debug('Login Webhook received: ', $request->all());
    
        $receivedSid = $request->input('sid');
    
        // Validate the SID by checking the cache
        if (!Cache::has('sid_' . $receivedSid)) {
            Log::debug('Invalid session ID detected on login.', ['received_sid' => $receivedSid]);
            return response()->json(['message' => 'Invalid session ID'], 401);
        }
    
        $userData = $request->all();
        $name =  $userData['bytename'];
        //why not firstorfail? user might have been removed locally but is still available globally for this website
        //to ban a user, set user to disabled in laravel's user table, don't just remove.
        $user = User::firstOrCreate([
            'email' => $userData['email'],
        ], [
            'name' => $name,
            'password' => Hash::make(Str::random(16)), // Generate a random password
        ]);
    
        Auth::login($user); // Authenticate the user
        session()->save(); // Ensure the session is saved immediately
    
        Log::debug('User authenticated immediately after login: ' . (Auth::check() ? 'true' : 'false'));
    
    
        // Store the user's ID in the cache tied to the SID to indicate successful login
        Cache::put('authenticated_sid_' . $receivedSid, $user->id, now()->addMinutes(10));
    }

    //frontend status check endpoint
    public function check(Request $request)
    {
        $sid = $request->input('sid');
        $userId = Cache::get('authenticated_sid_' . $sid);
        Log::debug('Checking Sid: ' . $sid);
        if ($userId) {
            $user = User::find($userId);
            Log::debug('Checking Sid: ' . $userId);
            if ($user) {
                // The user is authenticated, proceed with your logic (e.g., return success response)
                return response()->json(['authenticated' => true, 'user' => $user]);
            }
        }
    
        // No authenticated user found for the SID
        return response()->json(['authenticated' => false]);
    }


    //login and redirect stub
    public function bwauth(Request $request)
    {
        Log::debug('BWAuth');
        $sid = $request->query('sid');
        Log::debug('BWAuth');
        if ($sid && Cache::has("authenticated_sid_{$sid}")) {
            // Retrieve the user ID from the cache
            $userId = Cache::get("authenticated_sid_{$sid}");
    
            // Find the user by the ID
            $user = User::find($userId);
            if (!$user) {
                Log::debug("User not found for SID: {$sid}");
                return redirect('/login')->withErrors('Your session has expired or is invalid.');
            }
            
            Log::debug('Checking Sid: ' . $sid);
            Auth::login($user); // Log the user in
            Log::debug('Logged in');
    
            // Remove the SID from the cache if you wish to prevent reuse
            Cache::forget("authenticated_sid_{$sid}");
            Cache::forget("sid_{$sid}");
    
            Log::debug('Finally! Redirecting to dashboard...');
            // Redirect to the intended dashboard page or just display it
            return redirect('/home');
        } else {
            // Handle invalid or expired SID
            return redirect('/login')->withErrors('Your session has expired or is invalid.');
        }
    }

    //sample page
    public function sample()
    {
    	return view('byteauth::login');
    }
    
}

