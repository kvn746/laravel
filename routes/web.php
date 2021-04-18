<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('main');
Route::view('/about', 'about')->name('about');

Route::get('articles', 'ArticlesController@index')->name('articles.index');
Route::get('articles/create', 'ArticlesController@create')->name('articles.create');
Route::get('articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::post('articles', 'ArticlesController@store')->name('articles.store');
Route::get('articles/{article}/edit', 'ArticlesController@edit')->name('articles.edit');
Route::patch('articles/{article}', 'ArticlesController@update')->name('articles.update');
Route::delete('articles/{article}', 'ArticlesController@destroy')->name('articles.destroy');

Route::get('contacts', 'ContactsController@index')->name('contacts.index');
Route::get('contacts/create', 'ContactsController@create')->name('contacts.create');
Route::post('contacts', 'ContactsController@store')->name('contacts.store');

Route::get('admin/feedback', 'ContactsController@index')->name('admin.feedback');
