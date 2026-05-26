<x-app-layout>
<div class="container py-4">

    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            Add Payment
        </div>

        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Reservation</label>
                    <select name="reservation_id" id="reservation_id" class="form-control" required>
                        <option value="">Select Reservation</option>

                        @foreach($reservations as $reservation)
                            <option value="{{ $reservation->id }}"
                                    data-final="{{ $reservation->final_amount }}">
                                {{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}
                                - Room {{ $reservation->room->room_number }}
                                - ₱{{ number_format($reservation->final_amount, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Final Amount</label>
                    <input type="number" id="final_amount" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Amount Paid</label>
                    <input type="number" name="amount" id="amount" class="form-control" step="0.01" min="0" required>
                </div>

    <div class="mb-3">
    <label>Payment Method</label>
    <select name="payment_method" class="form-control" required>
        <option value="">Select Payment Method</option>
        <option value="Cash">Cash</option>
        <option value="GCash">GCash</option>
        <option value="Credit Card">Credit Card</option>
        <option value="Debit Card">Debit Card</option>
        <option value="Bank Transfer">Bank Transfer</option>
        <option value="PayPal">PayPal</option>
    </select>
    </div>

                <button class="btn btn-primary">Save Payment</button>
            </form>
        </div>
    </div>

</div>

<script>
    const reservationSelect = document.getElementById('reservation_id');
    const finalAmountInput = document.getElementById('final_amount');
    const amountInput = document.getElementById('amount');

    reservationSelect.addEventListener('change', function () {
        const selected = reservationSelect.options[reservationSelect.selectedIndex];
        const finalAmount = parseFloat(selected.getAttribute('data-final')) || 0;

        finalAmountInput.value = finalAmount.toFixed(2);
        amountInput.value = finalAmount.toFixed(2);
    });
</script>
</x-app-layout>