<?php

namespace Arane\Base\Providers;

use Arane\Base\Services\Handlers\SystemService;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider {
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() {

        //Load migration and publish files to database/migrations folder
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');

        //Load translations and publish files to lang/vendor/base folder
        $this->loadTranslationsFrom(__DIR__ . '/../Lang', 'lang');

        //Publish config file
        $this->publishes([__DIR__ . '/../Config/default.php' => config_path('base.php'),], 'config');

        //Include package custom routes
        include __DIR__ . '/../Routes/api.php';
        include __DIR__ . '/../Routes/web.php';
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() {
    }
}
