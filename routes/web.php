<?php

use Illuminate\Support\Facades\Route;

route::get('/service', 'PushallServiceController@form')->name('service.form');
route::post('/service', 'PushallServiceController@send')->name('service.send');

Route::view('/', 'index')->name('main');
Route::view('/about', 'about')->name('about');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/articles/tags/{tag}', 'TagsController@index')->name('articles.tags');

Route::resource('articles', 'ArticlesController');

Route::get('contacts', 'ContactsController@index')->name('contacts.index');
Route::get('contacts/create', 'ContactsController@create')->name('contacts.create');
Route::post('contacts', 'ContactsController@store')->name('contacts.store');

Route::get('admin/feedback', 'ContactsController@index')->name('admin.feedback');

Route::resource('admin/articles', 'AdminArticlesController', ['as' => 'admin']);
Route::get('/admin/articles/tags/{tag}', 'AdminTagsController@index')->name('admin.articles.tags');

route::post('/comment', 'ArticleCommentsController@store')->name('comment.store');

Auth::routes();
