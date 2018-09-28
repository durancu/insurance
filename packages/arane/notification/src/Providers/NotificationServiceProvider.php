<?php

namespace Arane\Notification\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider {
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations/');

        $this->publishes([__DIR__ . '/../Config/default.php' => config_path('arane-notification.php'),], 'config');

        $this->loadViewsFrom(__DIR__ . '/../Views', 'view');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() {
    }
}