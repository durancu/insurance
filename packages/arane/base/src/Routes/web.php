<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Routing\Router;

$web = app('Illuminate\Routing\Router');

$web->group(['middleware' => 'web'], function (Router $web) {
    
    $web->group(['namespace' => 'Arane\Base\Services\Controllers'], function (Router $web) {
        
        // AUTHENTICATION ROUTES
        
/*        $web->get('login', 'Auth\LoginController@index')->name('login');
        $web->post('login', 'Auth\LoginController@login')->name('login');
        
        $web->get('register', 'Auth\RegisterController@index')->name('register');
        $web->post('register', 'Auth\RegisterController@register')->name('register');
        
        
        // Password Reset Routes...
        $web->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $web->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $web->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        $web->post('password/reset', 'Auth\ResetPasswordController@reset');
        
        
        $web->get('social/providers/redirect/{provider}', 'Auth\SocialController@redirectToProvider')->name('auth-provider.redirect');
        $web->get('social/providers/handle/{provider}', 'Auth\SocialController@handleProviderCallback')->name('auth-provider.handle');
        
        $web->group(['middleware' => 'auth'], function (Router $web) {
            
            $web->post('logout', 'Auth\LoginController@logout')->name('logout');
            $web->get('logout', 'Auth\LoginController@getLogout')->name('get-logout');
            
        });*/
        
        
    });
    
});

