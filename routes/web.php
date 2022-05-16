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
        Route::resource('roles', 'Admin\RoleController');
        Route::resource('categories', 'Admin\CategoryController');
        Route::resource('users', 'Admin\UserController');
        Route::resource('settings', 'Admin\SettingController');
        
    });
     Route::resource('userpages', 'UserPageController');
     Route::resource('tags', 'TagController');
     //show verify page
     Route::get('/otp', 'VerifyController@index')->name('otp.show');

     Route::post('/otp/store', 'VerifyController@store')->name('otp.store');
    // Default
    Route::get('/home', 'HomeController@index')->name('home')->middleware('otp');
});
