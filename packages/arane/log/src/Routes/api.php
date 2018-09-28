<?php

use Illuminate\Routing\Router;

$api= app('Illuminate\Routing\Router');

//API ROUTES

$api->group(['middleware' => 'api'], function (Router $api) {

    $api->group(['namespace' => 'Arane\Log\Services\Controllers','prefix' => 'api/v1',], function (Router $api) {

        $api->group(['middleware' => 'auth:api'], function (Router $api) {
    
            //LOG API ENDPOINTS 
            $api->group([], function (Router $api) {
                
                $api->get('logs', 'LogsController@index')->name('api.logs.index')->middleware(['permission:read-logs']);
                $api->get('logs/{log}', 'LogsController@show')->name('api.logs.show')->middleware(['permission:read-logs']);
                $api->post('logs/search', 'LogsController@search')->name('api.logs.search')->middleware(['permission:read-logs']);
                
            });

        });
    });
});

