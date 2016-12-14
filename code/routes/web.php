<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

// Static pages
Route::get('/', 'PagesController@home'); // Root route will be either home or feed if connected
Route::get('/about', 'PagesController@about');

// Users related routes
Route::get('/user/{id}', 'UsersController@profile')->name('userProfile');
Route::get('/user/{id}/stats', 'UsersController@statistics');
Route::get('/user/{id}/films', 'UsersController@watchedFilms');
Route::get('/suggestions', 'UsersController@suggestions');
Route::get('/user/search/{query}', 'UsersController@search');
Route::post('/user/subscribeToggle', 'UsersController@subscribeToggle')->name('subscriptionToggle');
Route::post('/suggestions/{id}/accept', 'SuggestionsController@acceptSuggestion')->name('acceptSuggestion');
Route::post('/suggestions/{id}/watched', 'SuggestionsController@watchedSuggestion')->name('watchedSuggestion');
Route::post('/suggestions/{id}/refuse', 'SuggestionsController@refuseSuggestion')->name('refuseSuggestion');

// Feed him
Route::get('/feed', 'UsersController@feed');

// Film related views
Route::get('/film/{id}', 'FilmsController@film')->name('moviePage');
Route::get('/film/search/{query}', 'FilmsController@search');
Route::get('/suggest', 'FilmsController@suggestFilm');
Route::post('/film/watched', 'FilmsController@watched');
Route::post('/film/suggestToFriend', 'FilmsController@suggestToFriend');
Route::post('/film/addNote', 'FilmsController@addNote');
Route::post('/film/modifyNote', 'FilmsController@modifyNote');
Route::post('/addToDB', 'FilmsController@addToDB');
