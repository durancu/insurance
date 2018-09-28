<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Routing\Router;

$api = app('Illuminate\Routing\Router');

$api->group(['middleware' => 'api'], function (Router $api) {
    
    $api->group(['namespace' => 'Arane\Notification\Services\Controllers', 'prefix' => 'api/v1',], function (Router $api) {
        
        $api->group(['middleware' => ['auth:api']], function (Router $api) {
            
            $api->group(['middleware' => [], 'prefix' => 'notifications'], function (Router $api) {
                
                //NOTIFICATION CHANNELS API ENDPOINTS
                $api->get('channels', 'NotificationChannelsController@index')->name('api.notification-channels.index')->middleware(['permission:read-notification-channels']);
                $api->get('channels/{channel}', 'NotificationChannelsController@show')->name('api.notification-channels.show')->middleware(['permission:read-notification-channels']);
                $api->post('channels', 'NotificationChannelsController@store')->name('api.notification-channels.store')->middleware(['permission:write-notification-channels']);
                $api->put('channels/{channel}', 'NotificationChannelsController@update')->name('api.notification-channels.update')->middleware(['permission:write-notification-channels']);
                $api->post('channels/update', 'NotificationChannelsController@bulkUpdate')->name('api.notification-channels.bulk-update')->middleware(['permission:write-notification-channels']);
                $api->delete('channels/{channel}', 'NotificationChannelsController@destroy')->name('api.notification-channels.delete')->middleware(['permission:delete-notification-channels']);
                $api->post('channels/delete', 'NotificationChannelsController@bulkDestroy')->name('api.notification-channels.bulk-delete')->middleware(['permission:delete-notification-channels']);
                $api->patch('channels/{channel}', 'NotificationChannelsController@restore')->name('api.notification-channels.restore')->middleware(['permission:delete-notification-channels']);
                $api->post('channels/restore', 'NotificationChannelsController@bulkRestore')->name('api.notification-channels.bulk-restore')->middleware(['permission:delete-notification-channels']);
                $api->post('channels/search', 'NotificationChannelsController@search')->name('api.notification-channels.search')->middleware(['permission:read-notification-channels']);
                $api->post('channels/list-options', 'NotificationChannelsController@listAsOptions')->name('api.notification-channels.list-options')->middleware(['permission:read-notification-channels']);
    
                //NOTIFICATION SUBSCRIPTIONS API ENDPOINTS
                $api->get('subscriptions', 'NotificationSubscriptionsController@index')->name('api.notification-subscriptions.index')->middleware(['permission:read-notification-subscriptions']);
                $api->get('subscriptions/{subscription}', 'NotificationSubscriptionsController@show')->name('api.notification-subscriptions.show')->middleware(['permission:read-notification-subscriptions']);
                $api->post('subscriptions', 'NotificationSubscriptionsController@store')->name('api.notification-subscriptions.store')->middleware(['permission:write-notification-subscriptions']);
                $api->put('subscriptions/{subscription}', 'NotificationSubscriptionsController@update')->name('api.notification-subscriptions.update')->middleware(['permission:write-notification-subscriptions']);
                $api->post('subscriptions/update', 'NotificationSubscriptionsController@bulkUpdate')->name('api.notification-subscriptions.bulk-update')->middleware(['permission:write-notification-subscriptions']);
                $api->delete('subscriptions/{subscription}', 'NotificationSubscriptionsController@destroy')->name('api.notification-subscriptions.delete')->middleware(['permission:delete-notification-subscriptions']);
                $api->post('subscriptions/delete', 'NotificationSubscriptionsController@bulkDestroy')->name('api.notification-subscriptions.bulk-delete')->middleware(['permission:delete-notification-subscriptions']);
                $api->patch('subscriptions/{subscription}', 'NotificationSubscriptionsController@restore')->name('api.notification-subscriptions.restore')->middleware(['permission:delete-notification-subscriptions']);
                $api->post('subscriptions/restore', 'NotificationSubscriptionsController@bulkRestore')->name('api.notification-subscriptions.bulk-restore')->middleware(['permission:delete-notification-subscriptions']);
                $api->post('subscriptions/search', 'NotificationSubscriptionsController@search')->name('api.notification-subscriptions.search')->middleware(['permission:read-notification-subscriptions']);
                $api->post('subscriptions/list-options', 'NotificationSubscriptionsController@listAsOptions')->name('api.notification-subscriptions.list-options')->middleware(['permission:read-notification-subscriptions']);
    
            });
            
            
        });
    });
    
});