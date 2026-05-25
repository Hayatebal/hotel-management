<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Guest;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['room', 'guest'])->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $guests = Guest::orderBy('first_name')->get();
        $rooms = Room::where('status', 'available')->get();

        return view('reservations.create', compact('guests', 'rooms'));
    }

    public function store(Request $request)
    {
        Reservation::create([
            'guest_id' => $request->guest_id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'pending',
        ]);

        Room::find($request->room_id)?->update([
            'status' => 'reserved',
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully.');
    }

    public function edit(Reservation $reservation)
    {
        $guests = Guest::orderBy('first_name')->get();
        $rooms = Room::all();

        return view('reservations.edit', compact('reservation', 'guests', 'rooms'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $oldRoomId = $reservation->room_id;

        $reservation->update([
            'guest_id' => $request->guest_id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => $request->status,
        ]);

        if ($oldRoomId != $request->room_id) {
            Room::find($oldRoomId)?->update(['status' => 'available']);
        }

        if ($request->status === 'checked_in') {
            Room::find($request->room_id)?->update(['status' => 'occupied']);
        } elseif ($request->status === 'checked_out' || $request->status === 'cancelled') {
            Room::find($request->room_id)?->update(['status' => 'available']);
        } else {
            Room::find($request->room_id)?->update(['status' => 'reserved']);
        }

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->room?->update([
            'status' => 'available',
        ]);

        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully.');
    }

    public function checkin($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'status' => 'checked_in',
        ]);

        $reservation->room?->update([
            'status' => 'occupied',
        ]);

        return back()->with('success', 'Guest checked in successfully.');
    }

    public function checkout($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'status' => 'checked_out',
        ]);

        $reservation->room?->update([
            'status' => 'available',
        ]);

        return back()->with('success', 'Guest checked out successfully.');
    }
}