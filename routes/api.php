<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'users'], function () {
    Route::post('login', 'Api\Auth\AuthController@login');

    Route::post('register', 'Api\Auth\AuthController@register');

    Route::post('refresh', 'Api\Auth\AuthController@refresh')
        ->middleware('jwt.refresh');
});

Route::get('organizations', 'Api\OrganizationController@index')
    ->middleware('jwt.auth');

Route::post('organizations', 'Api\OrganizationController@store')
    ->middleware('jwt.auth');

Route::get('organizations/{id}', 'Api\OrganizationController@show')
    ->where(['id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
    ->middleware('jwt.auth');

Route::put('organizations/{id}', 'Api\OrganizationController@update')
    ->where(['id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
    ->middleware('jwt.auth');

Route::delete('organizations/{id}', 'Api\OrganizationController@destroy')
    ->where(['id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
    ->middleware('jwt.auth');

Route::get('departments', 'Api\DepartmentController@index')
    ->where(['id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
    ->middleware('jwt.auth');


Route::get('files', 'Api\FileController@index')
    ->middleware('jwt.auth');

Route::post('files', 'Api\FileController@store')
    ->middleware('jwt.auth');

Route::get('files/{id}', 'Api\FileController@show')
    ->where(['id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
    ->middleware('jwt.auth');

Route::get('files/download/{id}', 'Api\FileController@download')
    ->where(['id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
    ->middleware('jwt.auth');

Route::delete('files/{id}', 'Api\FileController@destroy')
    ->where(['id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
    ->middleware('jwt.auth');

Route::get('roles', 'Api\RoleController@index')
    ->middleware('jwt.auth');