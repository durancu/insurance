<?php

use Illuminate\Routing\Router;

$api = app('Illuminate\Routing\Router');
//API ROUTES
$api->group(['middleware' => ['api']], function (Router $api) {
    
    $api->group(['namespace' => 'Arane\File\Services\Controllers', 'prefix' => 'api/v1'], function (Router $api) {
        
        $api->group(['middleware' => 'auth:api'], function (Router $api) {
            
            
            $api->group(['middleware' => []], function (Router $api) {
                
                //FILES API ENDPOINTS
    
                $api->get('files', 'FilesController@index')->name('api.files.index')->middleware(['permission:read-files']);
                $api->get('files/{file}', 'FilesController@show')->name('api.files.show')->middleware(['permission:read-files']);
                $api->post('files', 'FilesController@store')->name('api.files.store')->middleware(['permission:write-files']);
                $api->put('files/{file}', 'FilesController@update')->name('api.files.update')->middleware(['permission:write-files']);
                $api->post('files/update', 'FilesController@bulkUpdate')->name('api.files.bulk-update')->middleware(['permission:write-files']);
                $api->delete('files/{file}', 'FilesController@destroy')->name('api.files.delete')->middleware(['permission:delete-files']);
                $api->post('files/delete', 'FilesController@bulkDestroy')->name('api.files.bulk-delete')->middleware(['permission:delete-files']);
                $api->patch('files/{file}', 'FilesController@restore')->name('api.files.restore')->middleware(['permission:delete-files']);
                $api->post('files/restore', 'FilesController@bulkRestore')->name('api.files.bulk-restore')->middleware(['permission:delete-files']);
                $api->post('files/search', 'FilesController@search')->name('api.files.search')->middleware(['permission:read-files']);
                $api->post('files/list-options', 'FilesController@listAsOptions')->name('api.files.list-options')->middleware(['permission:read-files']);
    
                $api->post('files/copy/{file}', 'FilesController@copy')->name('api.files.copy')->middleware(['permission:copy-files']);
                $api->post('files/move/{file}', 'FilesController@move')->name('api.files.move')->middleware(['permission:move-files']);
           
            });
        
        });
    });
});




