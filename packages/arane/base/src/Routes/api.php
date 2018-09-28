<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Routing\Router;

$api = app('Illuminate\Routing\Router');

$api->group(['middleware' => 'api'], function (Router $api) {
    
    $api->group(['namespace' => 'Arane\Base\Services\Controllers', 'prefix' => 'api/v1',], function (Router $api) {
        
        $api->group(['prefix' => 'auth'], function (Router $api) {
            
            //AUTHENTICATION ROUTES
            $api->group(['middleware' => 'guest'], function (Router $api) {
                $api->post('register', 'Auth\RegisterController@register')->name('api.auth.register');
                $api->post('login', 'Auth\LoginController@login')->name('api.auth.login');
                $api->post('refresh', 'Auth\LoginController@refresh')->name('api.auth.refresh');
            });
            
            $api->group(['middleware' => 'auth:api'], function (Router $api) {
                $api->get('logout', 'Auth\LoginController@getLogout')->name('api.auth.get-logout');
                $api->post('logout', 'Auth\LoginController@logout')->name('api.auth.logout');
                $api->get('me', 'Auth\LoginController@me')->name('api.auth.me');
            });
        });
        
        $api->group(['middleware' => 'auth:api'], function (Router $api) {
            
            //USERS API ENDPOINTS
            $api->group(['middleware' => []], function (Router $api) {
    
                $api->get('users', 'UsersController@index')->name('api.users.index')->middleware(['permission:read-users']);
                $api->get('users/{user}', 'UsersController@show')->name('api.users.show')->middleware(['permission:read-users']);
                $api->post('users', 'UsersController@store')->name('api.users.store')->middleware(['permission:write-users']);
                $api->put('users/{user}', 'UsersController@update')->name('api.users.update')->middleware(['permission:write-users']);
                $api->post('users/update', 'UsersController@bulkUpdate')->name('api.users.bulk-update')->middleware(['permission:write-users']);
                $api->delete('users/{user}', 'UsersController@destroy')->name('api.users.delete')->middleware(['permission:delete-users']);
                $api->post('users/delete', 'UsersController@bulkDestroy')->name('api.users.bulk-delete')->middleware(['permission:delete-users']);
                $api->patch('users/{user}', 'UsersController@restore')->name('api.users.restore')->middleware(['permission:delete-users']);
                $api->post('users/restore', 'UsersController@bulkRestore')->name('api.users.bulk-restore')->middleware(['permission:delete-users']);
                $api->post('users/search', 'UsersController@search')->name('api.users.search')->middleware(['permission:read-users']);
                $api->post('users/list-options', 'UsersController@listAsOptions')->name('api.users.list-options')->middleware(['permission:read-users']);
            });
            
            // USER ROLES API ENDPOINTS
            $api->group(['middleware' => []], function (Router $api) {
                
                $api->get('roles', 'RolesController@index')->name('api.roles.index')->middleware(['permission:read-roles']);
                $api->get('roles/{role}', 'RolesController@show')->name('api.roles.show')->middleware(['permission:read-roles']);
                $api->post('roles', 'RolesController@store')->name('api.roles.store')->middleware(['permission:write-roles']);
                $api->put('roles/{role}', 'RolesController@update')->name('api.roles.update')->middleware(['permission:write-roles']);
                $api->post('roles/update', 'RolesController@bulkUpdate')->name('api.roles.bulk-update')->middleware(['permission:write-roles']);
                $api->delete('roles/{role}', 'RolesController@destroy')->name('api.roles.delete')->middleware(['permission:delete-roles']);
                $api->post('roles/delete', 'RolesController@bulkDestroy')->name('api.roles.bulk-delete')->middleware(['permission:delete-roles']);
                $api->patch('roles/{role}', 'RolesController@restore')->name('api.roles.restore')->middleware(['permission:delete-roles']);
                $api->post('roles/restore', 'RolesController@bulkRestore')->name('api.roles.bulk-restore')->middleware(['permission:delete-roles']);
                $api->post('roles/search', 'RolesController@search')->name('api.roles.search')->middleware(['permission:read-roles']);
                $api->post('roles/list-options', 'RolesController@listAsOptions')->name('api.roles.list-options')->middleware(['permission:read-roles']);
                
                
            });
            
            // USER PERMISSIONS API ENDPOINTS
            $api->group(['middleware' => []], function (Router $api) {
    
                $api->get('permissions', 'PermissionsController@index')->name('api.permissions.index')->middleware(['permission:read-permissions']);
                $api->get('permissions/{permission}', 'PermissionsController@show')->name('api.permissions.show')->middleware(['permission:read-permissions']);
                $api->post('permissions', 'PermissionsController@store')->name('api.permissions.store')->middleware(['permission:write-permissions']);
                $api->put('permissions/{permission}', 'PermissionsController@update')->name('api.permissions.update')->middleware(['permission:write-permissions']);
                $api->post('permissions/update', 'PermissionsController@bulkUpdate')->name('api.permissions.bulk-update')->middleware(['permission:write-permissions']);
                $api->delete('permissions/{permission}', 'PermissionsController@destroy')->name('api.permissions.delete')->middleware(['permission:delete-permissions']);
                $api->post('permissions/delete', 'PermissionsController@bulkDestroy')->name('api.permissions.bulk-delete')->middleware(['permission:delete-permissions']);
                $api->patch('permissions/{permission}', 'PermissionsController@restore')->name('api.permissions.restore')->middleware(['permission:delete-permissions']);
                $api->post('permissions/restore', 'PermissionsController@bulkRestore')->name('api.permissions.bulk-restore')->middleware(['permission:delete-permissions']);
                $api->post('permissions/search', 'PermissionsController@search')->name('api.permissions.search')->middleware(['permission:read-permissions']);
                $api->post('permissions/list-options', 'PermissionsController@listAsOptions')->name('api.permissions.list-options')->middleware(['permission:read-permissions']);
                
            });
            
        });
        
        
        //PUBLIC API ENDPOINTS
        $api->group(['prefix' => 'public',], function (Router $api) {
            $api->post('countries', 'PublicController@countries')->name('api.public.countries');
            $api->post('states', 'PublicController@states')->name('api.public.states');
        });
        
    });
});