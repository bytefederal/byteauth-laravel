<?php

namespace ByteFederal\ByteAuthLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class ByteAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Binding code here
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
	 \Livewire\Livewire::component('q-r-login', \ByteFederal\ByteAuthLaravel\Livewire\QRLogin::class);

        // Load views, routes, etc.
    	$this->loadViewsFrom(__DIR__.'/../resources/views', 'byteauth');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/byteauth'),
        ], 'byteauth-views');

        // If your package has routes, you can load them like this
	// $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
	//
	    __DIR__.'/../config/byteauth.php' => config_path('byteauth.php'),
    	], 'config');
    }

    public function register()
    {
    	$this->mergeConfigFrom(
        	__DIR__.'/../config/byteauth.php', 'byteauth'
    	);
    }
}
