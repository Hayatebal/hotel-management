<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE ROUTES
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | RESOURCE ROUTES
    |--------------------------------------------------------------------------
    */

    Route::resource('rooms', RoomController::class);

    Route::resource('guests', GuestController::class);

    Route::resource('reservations', ReservationController::class);

    Route::resource('payments', PaymentController::class);

    /*
    |--------------------------------------------------------------------------
    | RESERVATION ROUTES
    |--------------------------------------------------------------------------
    */

    Route::post('/reservations/{id}/checkin',
        [ReservationController::class, 'checkin'])
        ->name('reservations.checkin');

    Route::get('/reservations/{reservation}/checkin-receipt',
        [ReservationController::class, 'checkinReceipt'])
        ->name('reservations.checkinReceipt');

    /*
    |--------------------------------------------------------------------------
    | PAYMENT ROUTES
    |--------------------------------------------------------------------------
    */

    Route::get('/payments/{payment}/checkout-receipt',
        [PaymentController::class, 'checkoutReceipt'])
        ->name('payments.checkoutReceipt');

});

require __DIR__.'/auth.php';