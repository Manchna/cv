<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//for login facebook google twitter

Route::group(['prefix' => '/auth'], function () {
    Route::get('/{provider}', 'Auth\RegisterController@redirectToProvider');
    Route::get('/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
});

//for users

Route::group(['prefix' => '/user'], function () {
    Route::post('/update/{id}', 'HomeController@update')->name('user_update');
    Route::get('/delete/{id}', 'HomeController@destroy')->name('user_delete');
});

//for admin

Route::group(['prefix' => '/admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/create/user', 'AdminController@create_user')->name('admin_create_user');
    Route::post('/send/user', 'AdminController@store')->name('admin_send_user');
    Route::get('/users', 'AdminController@users')->name('admin_users');
    Route::get('/user/{id}', 'AdminController@show')->name('admin_user');
    Route::post('/update/user/{id}', 'AdminController@update')->name('admin_user_update');
    Route::get('/delete/user/{id}', 'AdminController@destroy')->name('admin_user_delete');
});

