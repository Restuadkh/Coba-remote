<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
    // Rute yang memerlukan autentikasi
    // ... tambahkan rute lain yang memerlukan autentikasi di sini
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', 'UserController');
    Route::resource('events', 'EventController');
    Route::resource('bookings', 'BookingController');
    Route::resource('orders', 'OrderController');
    Route::resource('products', 'ProductController');
    Route::resource('payments', 'PaymentController');
    Route::resource('payment_methods', 'PaymentMethodController');
    Route::resource('pays', 'PayController');
});

Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);

Route::post('/pays/callback', [PayController::class, 'callback']);
