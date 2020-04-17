<?php

//Auth::routes();

// Route::post('login', 'Auth\LoginController@login');



// Route::get('/', 'WelcomeController@showWelcomePage')->name('welcome');

Route::get('/{vue?}', 'SinglePageController@index')->where('vue', '[\/\w\.-]*')->name('home');
