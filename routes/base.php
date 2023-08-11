<?php

use Illuminate\Support\Facades\Route;
use App\Enums\RoleEnum;

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

Route::group(['middleware' => ['auth', 'dashboard.access', 'verified:dashboard.auth.verification.notice']], function () {
    Route::group(["as" => "indonesia.", "prefix" => "indonesia"], function () {
        Route::get('/province', 'IndonesiaController@province')->name('province');
        Route::get('/city', 'IndonesiaController@city')->name('city');
        Route::get('/district', 'IndonesiaController@district')->name('district');
        Route::get('/village', 'IndonesiaController@village')->name('village');
    });
});