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

Route::get('/', function () {
    return view('index');
})->name('main');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/about/us', function () {
    return view('about_us', compact('title', 'h1', 'description'));
})->name('about.us');

Route::get('articles', 'ArticlesController@index')->name('articles');
Route::get('articles/create', 'ArticlesController@add')->name('articles.create');
Route::get('articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::post('articles', 'ArticlesController@create');

Route::get('contacts', 'ContactsController@index')->name('contacts');
Route::get('admin/feedback', 'ContactsController@show')->name('admin.feedback');
Route::post('contacts', 'ContactsController@create');
