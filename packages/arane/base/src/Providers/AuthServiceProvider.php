<?php

namespace Arane\Base\Providers;

use Illuminate\Support\Facades\Blade;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Arane\Base\Models\Entities\User' => 'Arane\Base\Models\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot() {

        $this->registerPolicies();

        Passport::routes();

        Passport::enableImplicitGrant();

        Passport::tokensExpireIn(now()->addDay(1));

        Passport::refreshTokensExpireIn(now()->addDays(3));


        Blade::if('admin', function () {
            return auth()->user()->isSuperAdmin();
        });

    }
}
