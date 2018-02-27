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
    Route::post('/update/{id}', 'HomeController@update')->name('userUpdate');
    Route::get('/delete/{id}', 'HomeController@destroy')->name('userDelete');
});

//for admin
Route::group(['prefix' => '/admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/create/user', 'AdminController@createUser')->name('adminCreateUser');
    Route::post('/send/user', 'AdminController@storeUser')->name('adminSendUser');
    Route::get('/users', 'AdminController@users')->name('adminUsers');
    Route::get('/user/{id}', 'AdminController@showUser')->name('adminUser');
    Route::post('/update/user/{id}', 'AdminController@updateUser')->name('adminUserUpdate');
    Route::get('/delete/user/{id}', 'AdminController@destroyUser')->name('adminUserDelete');
});

