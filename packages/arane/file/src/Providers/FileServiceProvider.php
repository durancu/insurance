<?php

namespace Arane\File\Providers;

use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider {
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() {
        //Load migration and publish files to database/migrations folder
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        
        //Publish config file
        $this->publishes([__DIR__ . '/../Config/default.php' => config_path('arane-file.php'),], 'config');

        //Load translations and publish files to lang/vendor/file folder
        $this->loadTranslationsFrom(__DIR__ . '/../Lang', 'lang');

        //Include package custom routes
        include __DIR__ . '/../Routes/api.php';
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() {

        //Register EvenServicesProvider
        $this->app->register(EventServiceProvider::class);

    }
}
