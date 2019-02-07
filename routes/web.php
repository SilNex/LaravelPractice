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

Route::post('/posts/{post}', 'PostController@passwordCheck')->name('posts.passCheck');
Route::resource('posts', 'PostController');

Route::get('/profile', 'UserProfileController@show')->name('profile.show');
Route::put('/profile', 'UserProfileController@update')->name('profile.update');
Route::delete('/profile', 'UserProfileController@destroy')->name('profile.destroy');

Route::resource('posts/{post}/comments', 'CommentController');

Route::get('/fileupload', 'FileUploadController@index');
Route::put('/fileupload', 'FileUploadController@update');