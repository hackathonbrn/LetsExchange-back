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

use Illuminate\Support\Facades\Cache;
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Cache::flush();
    
    return "Кэш очищен.";
});

Route::post('/verifild','VerifildsController@VirifildApp');

Route::get('/allConsole','ConsoleController@listConsole');

Route::get('/allSliders','SlidersController@listSliders');

Route::get('/search-game','GameController@searchGame');

Route::get('/', function () {
    abort(404, 'Page not found');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
