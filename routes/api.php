<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'LoginController@login')->name('login');
Route::post('/register', 'LoginController@register')->name('register');

Route::prefix('weather/report')->middleware(['request.logging', 'auth:api'])->group(function () {
    Route::get('/pdf', 'ReportController@getPdf');
    Route::get('/json', 'ReportController@getJson');
    Route::get('/text', 'ReportController@getText');
    Route::get('/html', 'ReportController@getHtml');
});
