<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use App\Models\Payment;

class DashboardController extends Controller
{
    
public function index()
{
    return view('dashboard', [
        'totalRooms' => (int) Room::count(),
        'availableRooms' => (int) Room::where('status','Available')->count(),
        'occupiedRooms' => (int) Room::where('status','Occupied')->count(),

        'reservations' => (int) Reservation::count(),
        'checkins' => (int) Reservation::where('status','Checked-in')->count(),
        'checkouts' => (int) Reservation::where('status','Checked-out')->count(),

        'revenue' => (float) Payment::sum('amount'),
    ]);
}
}