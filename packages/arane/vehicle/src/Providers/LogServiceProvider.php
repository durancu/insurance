<?php

namespace Arane\Vehicle\Providers;

use Illuminate\Support\ServiceProvider;

class VehicleServiceProvider extends ServiceProvider {
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() {
        //Load and Publish Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations/');

        $this->publishes([__DIR__ . '/../Migrations' => database_path('migrations'),], 'migration');

        //Include package custom routes
        include __DIR__ . '/../Routes/api.php';
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() {
    }
}