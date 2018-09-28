<?php

use Illuminate\Routing\Router;

//API ROUTES

$api = app('Illuminate\Routing\Router');

$api->group(['middleware' => 'api'], function (Router $api) {
    
    $api->group(['namespace' => 'Arane\Sharepoint\Services\Controllers', 'prefix' => 'api/v1'], function (Router $api) {
        
        $api->group(['middleware' => 'auth:api'], function (Router $api) {
            
            //ACCESS ONLY TO ACCOUNT-ADMIN USERS, OR USERS WITH DELETE-FILES PERMISSION
            $api->group(['middleware' => []], function (Router $api) {
    
                // SHAREPOINTS API ENDPOINTS
                $api->get('sharepoints', 'SharepointsController@index')->name('api.sharepoints.index')->middleware(['permission:read-sharepoints']);
                $api->get('sharepoints/{sharepoint}', 'SharepointsController@show')->name('api.sharepoints.show')->middleware(['permission:read-sharepoints']);
                $api->post('sharepoints', 'SharepointsController@store')->name('api.sharepoints.store')->middleware(['permission:write-sharepoints']);
                $api->put('sharepoints/{sharepoint}', 'SharepointsController@update')->name('api.sharepoints.update')->middleware(['permission:write-sharepoints']);
                $api->post('sharepoints/update', 'SharepointsController@bulkUpdate')->name('api.sharepoints.bulk-update')->middleware(['permission:write-sharepoints']);
                $api->delete('sharepoints/{sharepoint}', 'SharepointsController@destroy')->name('api.sharepoints.delete')->middleware(['permission:delete-sharepoints']);
                $api->post('sharepoints/delete', 'SharepointsController@bulkDestroy')->name('api.sharepoints.bulk-delete')->middleware(['permission:delete-sharepoints']);
                $api->patch('sharepoints/{sharepoint}', 'SharepointsController@restore')->name('api.sharepoints.restore')->middleware(['permission:delete-sharepoints']);
                $api->post('sharepoints/restore', 'SharepointsController@bulkRestore')->name('api.sharepoints.bulk-restore')->middleware(['permission:delete-sharepoints']);
                $api->post('sharepoints/search', 'SharepointsController@search')->name('api.sharepoints.search')->middleware(['permission:read-sharepoints']);
                $api->post('sharepoints/list-options', 'SharepointsController@listAsOptions')->name('api.sharepoints.list-options')->middleware(['permission:read-sharepoints']);
    
                $api->post('sharepoints/copy/{sharepoint}', 'SharepointsController@copy')->name('api.sharepoints.copy')->middleware(['permission:delete-sharepoints']);
                $api->post('sharepoints/move/{sharepoint}', 'SharepointsController@move')->name('api.sharepoints.move')->middleware(['permission:delete-sharepoints']);
                $api->post('sharepoints/share/{sharepoint}', 'SharepointsController@share')->name('api.sharepoints.share')->middleware(['permission:write-sharepoints']);
                $api->post('sharepoints/unshare/{sharepoint}', 'SharepointsController@unshare')->name('api.sharepoints.unshare')->middleware(['permission:write-sharepoints']);
                $api->post('sharepoints/list-directory', 'SharepointsController@listDirectory')->name('api.sharepoints.list-directory')->middleware(['permission:read-sharepoints']);
                
            });
        });
    });
});


