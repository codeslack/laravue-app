<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'auth'], function () {
    Route::get('/check', 'Auth\AuthController@check');
    Route::post('/login', 'Auth\AuthController@login');
    Route::post('/register', 'Auth\AuthController@register');
    Route::post('/email-exist', 'Auth\AuthController@emailExist');

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'Auth\AuthController@logout');
    });
});




Route::group([
    'middleware' => 'auth:api',
], function () {

    Route::group([
        'name' => 'admin.',
        'prefix' => 'admin',
        'middleware' => 'admin'
    ], function () {

        // URL: /admin/users
        // Route name: admin.users
        // Route::apiResources(['user' => 'API\UserController']);
        Route::get('users', 'User\UserController@index')->name('users');
    });

    // front route list


    /**
     * global route list
     */
    Route::resource('services', 'Heads\ServiceHeadController', ['only' => ['index', 'show', 'store']]);


    /**
     * Drivings
     */
    Route::get('driving/process', 'Driving\DrivingLicenceController@process')->name('driving.process');
    Route::get('driving/hold', 'Driving\DrivingLicenceController@hold')->name('driving.hold');
    Route::get('driving/reject', 'Driving\DrivingLicenceController@reject')->name('driving.reject');
    Route::get('driving/success', 'Driving\DrivingLicenceController@success')->name('driving.success');
    Route::post('driving/reply', 'Driving\DrivingLicenceController@reply')->name('driving.reply');
    Route::resource('driving', 'Driving\DrivingLicenceController', ['only' => ['index', 'store', 'update', 'destroy']]);


    /**
     * Transactions
     */
    Route::name('transactions.check')->post('transactions/check', 'Voucher\VoucherController@check');
    Route::resource('transactions', 'Voucher\VoucherController', ['only' => ['index', 'show', 'store']]);
    
    
    
    /**
     * Users
     */
    Route::name('user.profile')->post('user/profile', 'User\UserController@updateProfile');
    Route::name('user.avatar')->post('user/avatar', 'User\UserController@updatePhoto');
    Route::resource('user', 'User\UserController', ['except' => ['create', 'store', 'edit', 'show']]);
    Route::name('user.verify')->get('user/verify/{token}', 'User\UserController@verify');
    Route::name('user.resend')->get('user/{user}/resend', 'User\UserController@resend');
    
    /**
     * Wallet
     */
    Route::group([
        'name' => 'user.',
        'prefix' => 'user',
    ], function () {

        // URL: /user/wallet
        // Route name: user.wallet
        Route::resource('wallet', 'Wallet\WalletRequestController');
    });
       

    // Route::name('admin.')->group(function () {
    //     Route::get('users', function () {
    //         // Route assigned name "admin.users"...
    //     })->name('users');
    // });


    // Route::resource('driving-affidavits', 'Affidavit\AffDrivingController', ['only' => ['index', 'show', 'store', 'destroy']]);
    // Route::name('driving-affidavits.print')->get('driving-affidavits/print/{driving_affidavit}', 'Affidavit\AffDrivingController@print');
});
