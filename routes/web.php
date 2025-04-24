<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group 
| which contains the "web" middleware group. Enjoy building your app!
|
*/

// Root route redirects to the login page.
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes with email verification enabled.
Auth::routes(['verify' => true]);

// Home route for authenticated users.
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Booking routes that require authentication and email verification.
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(BookingController::class)->group(function () {
        Route::get('/bookings/create', 'create')->name('bookings.create');
        Route::post('/bookings', 'store')->name('bookings.store');
    });
});
