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

$web->group(['middleware'=>['auth']], function (Router $web) {

});


//Homepage
Route::get('/', 'HomeController@index')->name('home');

//Authentication routes
Auth::routes();



