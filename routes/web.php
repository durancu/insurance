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
    $web->get('account', 'AccountController@index')->name('account');
});

//General pages routes
$web->get('about', 'HomeController@showAbout')->name('about');
$web->get('terms', 'HomeController@showTerms')->name('terms');
$web->get('help-center', 'HomeController@showHelpCenter')->name('help-center');
$web->get('plans', 'HomeController@showPlans')->name('plans')->middleware('guest');

//Careers routes
$web->get('careers', 'CareersController@index')->name('careers');
$web->get('careers/postulate', 'CareersController@postulate')->name('careers.postulate');


//Contact form routes
$web->get('contact', 'ContactController@index')->name('contact');
$web->post('contact/send', 'ContactController@sendMessage')->name('contact.send');


//Document routes
$web->get('documents', 'DocumentController@index')->name('documents');
$web->get('documents/{slug}', 'DocumentController@showDocumentDetail')->name('documents.detail');

//Order routes
$web->post('orders/{code}', 'QuestionnaireController@showQuestionnaire')->name('orders.questionnaire');


//Homepage
Route::get('/', 'HomeController@index')->name('home');

//Authentication routes
Auth::routes();



