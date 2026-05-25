<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile.edit');

    // Modules
    Route::resource('rooms', RoomController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('payments', PaymentController::class);

    // Reservation Actions
    Route::get('checkin/{id}', [ReservationController::class, 'checkin'])
        ->name('reservations.checkin');

    Route::get('checkout/{id}', [ReservationController::class, 'checkout'])
        ->name('reservations.checkout');
});

require __DIR__.'/auth.php';