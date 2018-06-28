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
            Route::get('profile', 'ProfileController@index')->name('profile');
            Route::patch('update/{user}', 'ProfileController@update')->name('profile.update');
            Route::resource('electrician', 'ElectricianController');
            Route::post('electriciansbulkdelete', 'ElectricianController@electriciansbulkdelete');
            Route::post('get_electrician_data', 'ElectricianController@get_electrician_data')->name('get_electrician_data');
            Route::resource('plumber', 'PlumberController');
            Route::post('get_plumber_data', 'PlumberController@get_plumber_data')->name('get_plumber_data');
            Route::resource('painter', 'PainterController');
            Route::post('get_painter_data', 'PainterController@get_painter_data')->name('get_painter_data');
            Route::resource('carpainter', 'CarPainterController');
            Route::post('get_carpainter_data', 'CarPainterController@get_carpainter_data')->name('get_carpainter_data');
            Route::resource('mason', 'MasonController');
            Route::post('get_mason_data', 'MasonController@get_mason_data')->name('get_mason_data');
        
        });


Route::get('/logout', 'Auth\LoginController@logout');