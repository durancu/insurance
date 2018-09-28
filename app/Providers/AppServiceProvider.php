<?php

namespace App\Providers;


use Arane\Base\Services\Rules\Mobile;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Validators\ReCaptcha;


class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
                ['form_params' =>
                    [
                        'secret' => config('services.google.recaptcha_secret'),
                        'response' => $value
                    ]
                ]
            );
            $body = json_decode((string)$response->getBody());
            
            return $body->success;
            
        });
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        if (env('APP_ENV') === 'production') {
            $this->app['url']->forceScheme('https');
        }
    }
}
