<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with([
            'reservation.guest',
            'reservation.room'
        ])->latest()->get();

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $reservations = Reservation::with(['guest', 'room'])
            ->where('status', 'checked_out')
            ->get();

        return view('payments.create', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'reference_number' => 'nullable|string|max:255',
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        $paymentStatus =
            $request->amount >= $reservation->final_amount
            ? 'paid'
            : 'pending';

        Payment::create([
            'reservation_id' => $request->reservation_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'reference_number' => $request->reference_number,
            'payment_date' => now(),
            'status' => $paymentStatus,
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment Added Successfully');
    }

    public function edit(Payment $payment)
    {
        $payment->load([
            'reservation.guest',
            'reservation.room'
        ]);

        $reservations = Reservation::with(['guest', 'room'])
            ->where('status', 'checked_out')
            ->get();

        return view(
            'payments.edit',
            compact('payment', 'reservations')
        );
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'reference_number' => 'nullable|string|max:255',
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        $paymentStatus =
            $request->amount >= $reservation->final_amount
            ? 'paid'
            : 'pending';

        $payment->update([
            'reservation_id' => $request->reservation_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'reference_number' => $request->reference_number,
            'payment_date' => now(),
            'status' => $paymentStatus,
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment Updated Successfully');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment Deleted Successfully');
    }

    public function checkoutReceipt(Payment $payment)
    {
        if ($payment->status !== 'paid') {
            return back()->with(
                'error',
                'Check-out receipt is only available for fully paid payments.'
            );
        }

        $payment->load([
            'reservation.guest',
            'reservation.room'
        ]);

        $pdf = Pdf::loadView(
            'payments.receipt',
            compact('payment')
        );

        return $pdf->download(
            'checkout-receipt-' . $payment->id . '.pdf'
        );
    }
}