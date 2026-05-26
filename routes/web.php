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

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile.edit');

    Route::resource('rooms', RoomController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('payments', PaymentController::class);

    Route::post('/reservations/{id}/checkin', [ReservationController::class, 'checkin'])
        ->name('reservations.checkin');

    Route::post('/reservations/{id}/checkout', [ReservationController::class, 'checkout'])
        ->name('reservations.checkout');

    Route::get('/reservations/{reservation}/checkin-receipt', [ReservationController::class, 'checkinReceipt'])
        ->name('reservations.checkinReceipt');

    Route::get('/payments/{payment}/checkout-receipt', [PaymentController::class, 'checkoutReceipt'])
        ->name('payments.checkoutReceipt');
});

require __DIR__.'/auth.php';