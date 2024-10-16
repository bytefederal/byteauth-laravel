<?php
namespace ByteFederal\ByteAuthLaravel\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class QRLogin extends Component
{
    public $sid = 'null';
    public $qrCode = '';
    public $qrCodeImage;

    public function mount()
    {
        $this->generateQRCode();
    }

    protected function getLivewireVersion()
    {
        if (class_exists('\Composer\InstalledVersions')) {
            return \Composer\InstalledVersions::getVersion('livewire/livewire');
        }
        return null;
    }

    public function generateQRCode()
    {
        if (!Auth::check()) {
            // Make a request to the FastAPI service to generate a new QR code
            $response = Http::get('https://auth.bytefederal.com/getqrcode', [
		        'domain' => config('byteauth.domain'),
                'api_key' => config('byteauth.api_key'),
                'protocol' => 'bytewallet', // or 'https' if desired
            ]);
    
            if ($response->successful()) {
                $data = $response->json();
                
                $this->sid = $data['sid']; // Update sid with the one provided by the API
                $this->qrCode = $data['qr']; // Direct URL to the QR code
                $this->qrCodeImage = base64_encode(QrCode::format('png')->size(250)->generate($this->qrCode));
                Cache::put('sid_' . $this->sid, $this->sid, now()->addMinutes(10)); // Adjust the time as needed
                Log::debug('Session generated', ['expected_sid' => $this->sid]);

                $version = $this->getLivewireVersion();

                if (version_compare($version, '3.0.0', '>=')) {
                    // Use Livewire 3 method
                    $this->dispatch('sidUpdated', $this->sid);
                } else {
                    // Use Livewire 2 method
                    $this->emit('sidUpdated', $this->sid);
                }    
            
            } else {
                // Handle errors, e.g., log them or display a message
                // For simplicity, we'll just log here
                \Log::error("Failed to fetch QR code: " . $response->body());
            }
        } else {
            // Handle already logged in state
        }
    }

    public function render()
    {
        return view('byteauth::livewire.qr-login');
    }

}

