<?php

use Illuminate\Support\Facades\Route;

Route::get('/service', 'PushallServiceController@form')->name('service.form');
Route::post('/service', 'PushallServiceController@send')->name('service.send');

Route::get('/', 'MainPageController@index')->name('main');
Route::view('/about', 'about')->name('about');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::resource('articles', 'ArticlesController');
Route::resource('news', 'NewsController');

Route::get('contacts', 'ContactsController@index')->name('contacts.index');
Route::get('contacts/create', 'ContactsController@create')->name('contacts.create');
Route::post('contacts', 'ContactsController@store')->name('contacts.store');

Route::get('admin/feedback', 'ContactsController@index')->name('admin.feedback');

Route::resource('admin/articles', 'AdminArticlesController', ['as' => 'admin']);
Route::resource('admin/news', 'AdminNewsController', ['as' => 'admin']);

Route::get('/tags/{tag}', 'TagsController@index')->name('tags');
Route::get('/admin/tags/{tag}', 'AdminTagsController@index')->name('admin.tags');

Route::get('/reports', 'AdminReportsController@index')->name('admin.reports');

Route::post('/comment/articles', 'ArticlesCommentsController@store')->name('comment.articles.store');
Route::post('/comment/news', 'NewsCommentsController@store')->name('comment.news.store');

Auth::routes();

Route::post('/statistics/', '\App\Services\AdminReportsService@getStatisticsReport')->name('statistics');

Route::post('/chat/', function() {
    broadcast(new \App\Events\ChatMessage(request('message'), auth()->user()))->toOthers();
})->middleware('auth');

//Route::get('/test/', function () {
//    //
//});

//Route::get('/test/', function () {
//    event(new \App\Events\SomeEvent('Some Text'));
//});

//Route::post('/statistics/', function () {
//    App\Jobs\StatisticsReport::dispatch();
//})->name('statistics');
