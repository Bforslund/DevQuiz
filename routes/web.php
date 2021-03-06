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



Auth::routes();


/* Authenticated users */
Route::middleware('auth')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/profile', 'UserController@show');

    Route::get('/profile/{id}', 'UserController@show')->name('profile.show');

    Route::get('/aboutus', function () {
        return view('aboutus');
    })->name('aboutus.show');
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact.show');
    Route::post('/contact', 'MessageController@store');

    Route::get('/customize', 'PictureController@showCustomize')->name('customize.show');
    Route::post('/customize', 'PictureController@updatePicture');
    Route::get('/grey', 'PictureController@greyPicture');
    Route::get('/pixalate', 'PictureController@pixalatePicture');

    Route::get('/quizpage/{subject}/{level}/', 'QuestionController@first');
    Route::get('/quizpage/{subject}/{level}/{id}/{correct}', 'QuestionController@next');


    Route::put('/profile/{id}', 'UserController@updateProfile')->name('profile.update');

    Route::get('/password/reset', 'UserController@resetPassword')->name('password.request');

    Route::put('/password/reset', 'UserController@updatePassword')->name('password.update');
});


/* ALLOW ONLY ADMIN TO ACCESS THOSE ROUTES */
Route::group(['middleware'=>'admin'], function(){
    Route::resource('/admin/users', 'UserController');
    Route::put('admin/users/{user}/admin', 'UserController@toAdmin');
    Route::put('admin/users/{user}/subscriber', 'UserController@toSubscriber');

    Route::resource('/admin/messages', 'MessageController')->middleware('auth');

    Route::resource('/admin/quizzes', 'QuestionController');
});
