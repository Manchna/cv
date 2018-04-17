<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Auth::routes();

Route::get('/home', 'User\HomeController@index')->name('home');

//for login facebook google twitter
Route::group(['prefix' => '/auth'], function () {
    Route::get('/{provider}', 'Auth\RegisterController@redirectToProvider');
    Route::get('/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
});

//for users
Route::group(['prefix' => '/user','middleware' => 'auth'], function () {
    Route::post('/update/{id}', 'User\HomeController@update')->name('userUpdate');
    Route::get('/delete/{id}', 'User\HomeController@destroy')->name('userDelete');
    Route::get('/asa', 'User\AnswerController@asa')->name('asa');
    Route::get('/create/profession', 'User\ProfessionController@create')->name('userCreateProfession');
    Route::post('/send/cv', 'User\AnswerController@store')->name('cvCreate');
    Route::post('/cv/update', 'User\AnswerController@update')->name('cvUpdate');
    Route::get('/pdf/view/{id}/{download}', 'User\HomeController@pdfView')->name('pdfView');

});

//for admin
Route::group(['prefix' => '/admin','middleware' => 'admin'], function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('/create/user', 'Admin\AdminController@createUser')->name('adminCreateUser');
    Route::post('/send/user', 'Admin\AdminController@storeUser')->name('adminSendUser');
    Route::get('/users', 'Admin\AdminController@users')->name('adminUsers');
    Route::get('/user/{id}', 'Admin\AdminController@showUser')->name('adminUser');
    Route::post('/update/user/{id}', 'Admin\AdminController@updateUser')->name('adminUserUpdate');
    Route::get('/delete/user/{id}', 'Admin\AdminController@destroyUser')->name('adminUserDelete');
    Route::get('/create/profession', 'Admin\ProfessionController@create')->name('adminCreateProfession');
    Route::post('/send/profession', 'Admin\ProfessionController@store')->name('adminSendProfession');
    Route::get('/create/question', 'Admin\QuestionController@create')->name('adminCreateQuestion');
    Route::post('/send/questions', 'Admin\QuestionController@store')->name('adminSendQuestion');
    Route::post('/cv/update/{id}', 'Admin\AnswerController@update')->name('adminCvUpdate');
    Route::get('/pdf/view/{id}/{download}', 'Admin\AdminController@pdfView')->name('adminPdfView');
});

