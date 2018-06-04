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

Route::get('/', 'Admin\DashboardController@index')->name('dashboard');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
/*ROUTES FOR ADMIN*/
Route::group(['namespace' => 'Admin', 'as' => 'admin::', 'prefix' => 'admin'], function() {
            Route::get('dashboard', 'DashboardController@index')->name('dashboard');
            Route::post('electriciansbulkdelete', 'ElectricianController@electriciansbulkdelete');
            Route::resource('electrician', 'ElectricianController');
            Route::get('profile', 'ProfileController@index')->name('profile');
            Route::patch('update/{user}', 'ProfileController@update')->name('profile.update');
            Route::post('get_electrician_data', 'ElectricianController@get_electrician_data')->name('get_electrician_data');
        
        });


Route::get('/logout', 'Auth\LoginController@logout');