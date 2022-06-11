<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('login');
});

Auth::routes();

// Admin Part
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Amin routes
        Route::resource('admins', 'Admin\AdminController');
        Route::get('/report', 'ReportController@adminIndex')->name('report.adminIndex');
        Route::resource('roles', 'Admin\RoleController');
        Route::resource('categories', 'Admin\CategoryController');
        Route::resource('users', 'Admin\UserController');
        Route::resource('settings', 'Admin\SettingController');      
    });
     Route::resource('userpages', 'UserPageController');
     Route::resource('tags', 'TagController');
     Route::resource('admintags', 'AdminTagController');
     Route::resource('report', 'ReportController');
    Route::get('/report/check/{id}', 'ReportController@check')->name('report.check');


     Route::get('/otp', 'VerifyController@index')->name('otp.show');

     Route::post('/otp/store', 'VerifyController@store')->name('otp.store');
    // Default
    Route::get('/home', 'HomeController@index')->name('home')->middleware('otp');

    Route::get('/payment', 'PaymentController@create')->name('payment.create');
    Route::post('/payment', 'PaymentController@store')->name('payment.store');
    Route::get('/payment/callback', 'PaymentController@callback')->name('payment.callback');
    Route::get('/instagramLogin', 'ReportController@login')->name('instagram.login');
    
});
Route::get('/payment', 'PaymentController@create')->name('payment.create');
Route::post('/payment', 'PaymentController@store')->name('payment.store');
Route::get('/payment/callback', 'PaymentController@callback')->name('payment.callback');
// Route::get('/userid/{username}', 'InstagramController@getUser')->name('instagram.getuser');

Route::get('/setredis', 'ReportController@setredis')->name('setredis');
Route::get('/getredis', 'ReportController@getredis')->name('getredis');
Route::get('/instagram', 'InstagramController@redirectToInstagramProvider');
 
Route::get('/instagram/callback', 'InstagramController@handleProviderInstagramCallback');