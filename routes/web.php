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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/reviews/{book}', 'ReviewController@show')->name('reviews.show');
    Route::post('/reviews/{book}', 'ReviewController@store')->name('reviews.store');
    Route::get('/borrow/{book}', 'BorrowController@create')->name('borrow.create');
    Route::post('/borrow/{book}', 'BorrowController@store')->name('borrow.store');
    Route::delete('/borrow/{book}', 'BorrowController@destroy')->name('borrow.destroy');
    Route::get('/home', 'HomeController@index');
    Route::resource('libraries', 'LibrariesController', ['except' => ['index', 'show']]);
    Route::post('libraries/{library}/upload', 'LibrariesController@upload')->name('libraries.upload');
    Route::resource('books', 'BooksController', ['except' => ['index', 'create', 'store']]);
});

Route::group(['domain' => '{slug}.library.dev'],function(){
   Route::get('/', 'LibrariesController@show')->name('libraries.show');
});
Route::get('/', 'WelcomeController@index');
