<?php

use Illuminate\Routing\Router;

$api= app('Illuminate\Routing\Router');

//API ROUTES

$api->group(['middleware' => 'api'], function (Router $api) {

    $api->group(['namespace' => 'Arane\Vehicle\Services\Controllers','prefix' => 'api/v1',], function (Router $api) {

        $api->group(['middleware' => 'auth:api'], function (Router $api) {
    
            //VEHICLE API ENDPOINTS
            $api->group([], function (Router $api) {
                
                $api->get('vehicles', 'VehiclesController@index')->name('api.vehicles.index')->middleware(['permission:read-vehicles']);
                $api->get('vehicles/{vehicle}', 'VehiclesController@show')->name('api.vehicles.show')->middleware(['permission:read-vehicles']);
                $api->post('vehicles/search', 'VehiclesController@search')->name('api.vehicles.search')->middleware(['permission:read-vehicles']);
                
            });

        });
    });
});

