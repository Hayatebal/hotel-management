<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Guest;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['room', 'guest'])
            ->latest()
            ->get();

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
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'extended_hours' => 'nullable|integer|min:0',
            'status' => 'required|string',
        ]);

        $room = Room::findOrFail($request->room_id);

        $durationHours = (int) $request->duration_hours;
        $extendedHours = (int) ($request->extended_hours ?? 0);

        $pricePerHour = $room->price_per_hour;
        $totalAmount = $pricePerHour * $durationHours;
        $extendedAmount = $pricePerHour * $extendedHours;
        $finalAmount = $totalAmount + $extendedAmount;

        $checkOut = date(
            'Y-m-d H:i:s',
            strtotime($request->check_in . ' +' . ($durationHours + $extendedHours) . ' hours')
        );

        Reservation::create([
            'guest_id' => $request->guest_id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $checkOut,
            'duration_hours' => $durationHours,
            'price_per_hour' => $pricePerHour,
            'total_amount' => $totalAmount,
            'extended_hours' => $extendedHours,
            'extended_amount' => $extendedAmount,
            'final_amount' => $finalAmount,
            'status' => $request->status,
        ]);

        $room->update([
            'status' => $request->status === 'checked_in' ? 'occupied' : 'reserved',
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
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'extended_hours' => 'nullable|integer|min:0',
            'status' => 'required|string',
        ]);

        $oldRoomId = $reservation->room_id;

        $room = Room::findOrFail($request->room_id);

        $durationHours = (int) $request->duration_hours;
        $extendedHours = (int) ($request->extended_hours ?? 0);

        $pricePerHour = $room->price_per_hour;
        $totalAmount = $pricePerHour * $durationHours;
        $extendedAmount = $pricePerHour * $extendedHours;
        $finalAmount = $totalAmount + $extendedAmount;

        $reservation->update([
            'guest_id' => $request->guest_id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'duration_hours' => $durationHours,
            'price_per_hour' => $pricePerHour,
            'total_amount' => $totalAmount,
            'extended_hours' => $extendedHours,
            'extended_amount' => $extendedAmount,
            'final_amount' => $finalAmount,
            'status' => $request->status,
        ]);

        if ($oldRoomId != $request->room_id) {
            Room::find($oldRoomId)?->update([
                'status' => 'available',
            ]);
        }

        if ($request->status === 'checked_in') {
            $room->update(['status' => 'occupied']);
        } elseif ($request->status === 'checked_out' || $request->status === 'cancelled') {
            $room->update(['status' => 'available']);
        } else {
            $room->update(['status' => 'reserved']);
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

    public function checkinReceipt(Reservation $reservation)
    {
        $reservation->load(['guest', 'room']);

        if (!in_array($reservation->status, ['checked_in', 'checked_out'])) {
            return back()->with('error', 'Check-in receipt is only available after check-in.');
        }

        $pdf = Pdf::loadView('reservations.receipt', compact('reservation'));

        return $pdf->download('check-in-receipt-' . $reservation->id . '.pdf');
    }
}