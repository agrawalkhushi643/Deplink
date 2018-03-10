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
Route::get('/v1/@{org}/{package}', 'PackageController@show');
Route::get('/v1/@{org}/{package}/download', 'PackageController@download');
Route::put('v1/@{org}/{package}/upload', 'PackageController@upload');
