<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'index')->name('main');
Route::view('/about', 'about')->name('about');

Route::resource('articles', 'ArticlesController');
Route::resource('contacts', 'ContactsController');

Route::get('admin/feedback', 'ContactsController@index')->name('admin.feedback');
