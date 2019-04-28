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

Route::get('/', function () {
    return view('index');
})->name('index');

// Auth::routes();

// Route::get('/admin/login', 'Auth/LoginController@index');
// Route::get('/admin', 'Admin/AdminController@index');

Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/admin/login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/posts', 'PostController@index')->name('posts');
