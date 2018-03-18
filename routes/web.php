<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication
$this->get('/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('/login', 'Auth\LoginController@login');
$this->post('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration
$this->get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('/register', 'Auth\RegisterController@register');

// Password Reset
$this->get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('/password/reset', 'Auth\ResetPasswordController@reset');

// Packages
Route::get('/', 'PackageController@index')->name('packages.index');
Route::get('/@{org}/{package}', 'PackageController@show')->name('packages.show');
Route::get('/packages/create', 'PackageController@create')->name('packages.create');
Route::post('/packages', 'PackageController@store')->name('packages.store');
Route::get('/@{org}/{package}/edit', 'PackageController@edit')->name('packages.edit');
Route::put('/@{org}/{package}', 'PackageController@update')->name('packages.update');
Route::delete('/@{org}/{package}', 'PackageController@destroy')->name('packages.destroy');
