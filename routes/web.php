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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function()
{

    Route::get('/admin', 'AdminController@admin')->name('admin');

    Route::get('/admin/users', 'AdminController@users');
    Route::get('/admin/content', 'AdminController@content');
    Route::get('/admin/categories', 'AdminController@categories');
    Route::get('/admin/{category}', 'AdminController@itemtable');

    Route::any('/admin/create/category', 'AdminController@createcategory');
    Route::any('/admin/update/category/{slug}', 'AdminController@updatecategory');
    Route::any('/admin/delete/category/{slug}', 'AdminController@deletecategory');

    Route::any('/admin/update/user/{id}', 'AdminController@updateuser');
    Route::any('/admin/update/content/{id}', 'AdminController@updatecontent');

    Route::get('/admin/create/{category}', 'AdminController@createpage');
    Route::post('/admin/create/{category}', 'AdminController@create');
    Route::get('/admin/update/{category}/{id}', 'AdminController@updatepage');
    Route::post('/admin/update/{category}/{id}', 'AdminController@update');
    Route::any('/admin/delete/{category}/{id}', 'AdminController@delete');

    Route::any('/admin/deleteImage/{category}/{id}', 'AdminController@deleteImage');
});

Route::get('/item/{category}/{id}', 'HomeController@showItem');
