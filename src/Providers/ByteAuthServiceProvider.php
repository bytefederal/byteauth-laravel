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
        // Register bindings or other package services here

        // Merge package configuration file with the application's copy.
        $this->mergeConfigFrom(
            __DIR__.'/../config/byteauth.php', 'byteauth'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Livewire\Livewire::component('q-r-login', \ByteFederal\ByteAuthLaravel\Livewire\QRLogin::class);

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'byteauth');

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/byteauth'),
        ], 'byteauth-views');

        // Publish config
        $this->publishes([
            __DIR__.'/../config/byteauth.php' => config_path('byteauth.php'),
        ], 'byteauth-config');

         // Publish the WebhookController
        $this->publishes([
            __DIR__.'/../Controllers/WebhookController.php' => app_path('Http/Controllers/WebhookController.php'),
        ], 'byteauth-controllers');


        // Load routes, uncomment if you have routes to load
        // $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
