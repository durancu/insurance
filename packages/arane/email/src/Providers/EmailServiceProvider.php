<?php

namespace Arane\Email\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;

class EmailServiceProvider extends ServiceProvider {
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() {
        
        //Load migration and publish files to database/migrations folder
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        
        
        //Load translations and publish files to lang/vendor/arane/email folder
        $this->loadTranslationsFrom(__DIR__ . '/../Lang', 'lang');
        
        //Publish config file to Laravel config directory
        $this->publishes([__DIR__ . '/../Config/default.php' => config_path('arane-email.php'),], 'config');
    
        //Load package routes
        include __DIR__ . '/../Routes/api.php';
        
    }
    
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() {
        
        //Register the event service provider
        $this->app->register(\Arane\Email\Providers\EventServiceProvider::class);
    }
}