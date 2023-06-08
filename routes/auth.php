<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();



Route::get('/', function () {
    return view('auth.selection');
})->name('selection');


Route::get('/login/{type}', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login.show');

Route::post('/login/{type}', [LoginController::class, 'login'])->middleware('guest')->name('login');

Route::post('/logout/{type}', [LoginController::class, 'logout'])->name('logout');


// Route::group(
//     [
//         'prefix' => LaravelLocalization::setLocale(),
//         'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
//     ], function(){


//     });


