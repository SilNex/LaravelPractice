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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/{board}/posts', 'PostController');

Route::post('/posts/{post}/comments', 'CommentController@store')->name('comments.store');
Route::delete('/posts/{post}/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

Route::resource('/boards', 'BoardController');

