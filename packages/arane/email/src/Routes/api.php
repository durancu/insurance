<?php

use Illuminate\Routing\Router;

$api = app('Illuminate\Routing\Router');

$api->group(['middleware' => ['api'], 'prefix' => 'api/v1'], function (Router $api) {
    
    $api->group(['middleware' => [], 'namespace' => 'Arane\Email\Services\Controllers'], function (Router $api) {
        $api->group(['prefix' => 'email'], function (Router $api) {
            //EMAIL ENDPOINTS
            $api->post('send-contact', 'EmailsController@sendContactMessage')->name('api.email.send-contact');
        });
    });
    
    $api->group(['middleware' => ['auth:api'], 'namespace' => 'Arane\Email\Services\Controllers'], function (Router $api) {
        
        $api->group(['middleware' => []], function (Router $api) {
            
            $api->group(['prefix' => 'email'], function (Router $api) {
    
                //EMAIL SERVICE ENDPOINTS
                $api->post('send', 'EmailsController@send')->name('api.email.send')->middleware(['permission:send-emails']);
                
                //EMAIL TYPES ENDPOINTS
                $api->get('types', 'EmailTypesController@index')->name('api.email-types.index')->middleware(['permission:read-email-types']);
                $api->get('types/{type}', 'EmailTypesController@show')->name('api.email-types.show')->middleware(['permission:read-email-types']);
                $api->post('types', 'EmailTypesController@store')->name('api.email-types.store')->middleware(['permission:write-email-types']);
                $api->put('types/{type}', 'EmailTypesController@update')->name('api.email-types.update')->middleware(['permission:write-email-types']);
                $api->post('types/update', 'EmailTypesController@bulkUpdate')->name('api.email-types.bulk-update')->middleware(['permission:write-email-types']);
                $api->delete('types/{type}', 'EmailTypesController@destroy')->name('api.email-types.delete')->middleware(['permission:delete-email-types']);
                $api->post('types/delete', 'EmailTypesController@bulkDestroy')->name('api.email-types.bulk-delete')->middleware(['permission:delete-email-types']);
                $api->patch('types/{type}', 'EmailTypesController@restore')->name('api.email-types.restore')->middleware(['permission:delete-email-types']);
                $api->post('types/restore', 'EmailTypesController@bulkRestore')->name('api.email-types.bulk-restore')->middleware(['permission:delete-email-types']);
                $api->post('types/search', 'EmailTypesController@search')->name('api.email-types.search')->middleware(['permission:read-email-types']);
                $api->post('types/list-options', 'EmailTypesController@listAsOptions')->name('api.email-types.list-options')->middleware(['permission:read-email-types']);
                
                //EMAIL LISTS ENDPOINTS
                $api->get('lists', 'EmailListsController@index')->name('api.email-lists.index')->middleware(['permission:read-email-lists']);
                $api->get('lists/{list}', 'EmailListsController@show')->name('api.email-lists.show')->middleware(['permission:read-email-lists']);
                $api->post('lists', 'EmailListsController@store')->name('api.email-lists.store')->middleware(['permission:write-email-lists']);
                $api->put('lists/{list}', 'EmailListsController@update')->name('api.email-lists.update')->middleware(['permission:write-email-lists']);
                $api->post('lists/update', 'EmailListsController@bulkUpdate')->name('api.email-lists.bulk-update')->middleware(['permission:write-email-lists']);
                $api->delete('lists/{list}', 'EmailListsController@destroy')->name('api.email-lists.delete')->middleware(['permission:delete-email-lists']);
                $api->post('lists/delete', 'EmailListsController@bulkDestroy')->name('api.email-lists.bulk-delete')->middleware(['permission:delete-email-lists']);
                $api->patch('lists/{list}', 'EmailListsController@restore')->name('api.email-lists.restore')->middleware(['permission:delete-email-lists']);
                $api->post('lists/restore', 'EmailListsController@bulkRestore')->name('api.email-lists.bulk-restore')->middleware(['permission:delete-email-lists']);
                $api->post('lists/search', 'EmailListsController@search')->name('api.email-lists.search')->middleware(['permission:read-email-lists']);
                $api->post('lists/list-options', 'EmailListsController@listAsOptions')->name('api.email-lists.list-options')->middleware(['permission:read-email-lists']);
                
                //EMAIL TEMPLATES ENDPOINTS
                $api->get('templates', 'EmailTemplatesController@index')->name('api.email-templates.index')->middleware(['permission:read-email-templates']);
                $api->get('templates/{template}', 'EmailTemplatesController@show')->name('api.email-templates.show')->middleware(['permission:read-email-templates']);
                $api->post('templates', 'EmailTemplatesController@store')->name('api.email-templates.store')->middleware(['permission:write-email-templates']);
                $api->put('templates/{template}', 'EmailTemplatesController@update')->name('api.email-templates.update')->middleware(['permission:write-email-templates']);
                $api->post('templates/update', 'EmailTemplatesController@bulkUpdate')->name('api.email-templates.bulk-update')->middleware(['permission:write-email-templates']);
                $api->delete('templates/{template}', 'EmailTemplatesController@destroy')->name('api.email-templates.delete')->middleware(['permission:delete-email-templates']);
                $api->post('templates/delete', 'EmailTemplatesController@bulkDestroy')->name('api.email-templates.bulk-delete')->middleware(['permission:delete-email-templates']);
                $api->patch('templates/{template}', 'EmailTemplatesController@restore')->name('api.email-templates.restore')->middleware(['permission:delete-email-templates']);
                $api->post('templates/restore', 'EmailTemplatesController@bulkRestore')->name('api.email-templates.bulk-restore')->middleware(['permission:delete-email-templates']);
                $api->post('templates/search', 'EmailTemplatesController@search')->name('api.email-templates.search')->middleware(['permission:read-email-templates']);
                $api->post('templates/list-options', 'EmailTemplatesController@listAsOptions')->name('api.email-templates.list-options')->middleware(['permission:read-email-templates']);
            });
        });
    });
    
    
});