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

// Packages
Route::options('/@{org}/{package}', 'PackageController@check');
Route::get('/@{org}/{package}/versions', 'Packages\VersionController@index');
Route::get('/@{org}/{package}/{version}/deplink.json', 'PackageController@metadata');
Route::get('/@{org}/{package}/{version}/download', 'PackageController@download');
//Route::put('/@{org}/{package}/{version}/upload', 'PackageController@upload');
