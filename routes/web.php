<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route("landing-page.home.index");
});

Route::group(["as" => "home.", "prefix" => "/"], function () {
    Route::get('/', 'HomeController@index')->name('index');
});

Route::group(["as" => "galleries.", "prefix" => "/galleries"], function () {
    Route::get('/', 'GalleryController@index')->name('index');
});

Route::group(["as" => "contact-us.", "prefix" => "/contact-us"], function () {
    Route::get('/', 'ContactUsController@index')->name('index');
    Route::post('/', 'ContactUsController@store')->name('store');
});

Route::group(["as" => "potentials.", "prefix" => "/potentials"], function () {
    Route::get('/', 'PotentialController@index')->name('index');
    Route::get('/{slug}', 'PotentialController@show')->name('show');
    Route::get('/categories/{slug}', 'PotentialController@categories')->name('categories');
});

Route::group(["as" => "blogs.", "prefix" => "blogs"], function () {
    Route::get('/', 'BlogController@index')->name('index');
    Route::get('/{slug}', 'BlogController@show')->name('show');
    Route::get('/categories/{slug}', 'BlogController@categories')->name('categories');
});

Route::group(["as" => "announcements.", "prefix" => "announcements"], function () {
    Route::get('/', 'AnnouncementController@index')->name('index');
    Route::get('/{slug}', 'AnnouncementController@show')->name('show');
});

Route::group(["as" => "pages.", "prefix" => "pages"], function () {
    Route::get('/{slug}', 'PageController@index')->name('index');
});

Route::group(["as" => "organizations.", "prefix" => "organizations"], function () {
    Route::get('/', 'OrganizationController@index')->name('index');
});

Route::group(["as" => "populations.", "prefix" => "populations"], function () {
    Route::get('/', 'PopulationController@index')->name('index');
});

Route::group(["as" => "employees.", "prefix" => "employees"], function () {
    Route::get('/', 'EmployeeController@index')->name('index');
});

Route::group(["as" => "informations.", "prefix" => "/informations"], function () {
    Route::get('/', 'InformationController@index')->name('index');
    Route::get('/{slug}', 'InformationController@show')->name('show');
});

Route::group(["as" => "services.", "prefix" => "/services"], function () {
    Route::get('/', 'ServiceController@index')->name('index');
    Route::get('/{slug}', 'ServiceController@show')->name('show');
});


