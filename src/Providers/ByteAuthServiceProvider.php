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
        // Load views, routes, etc.
    	$this->loadViewsFrom(__DIR__.'/../resources/views', 'byteauth');
	$this->publishes([__DIR__.'/path/to/resources/views' => resource_path('views/vendor/byteauth'),], 'byteauth-views');
    }
}
