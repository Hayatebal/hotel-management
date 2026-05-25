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

                    <select name="reservation_id"
                            id="reservation_id"
                            class="form-control"
                            required>

                        <option value="">Select Reservation</option>

                        @foreach($reservations as $reservation)

                            <option value="{{ $reservation->id }}"
                                    data-total="{{ $reservation->final_amount }}">

                                {{ $reservation->guest->name ?? 'N/A' }}
                                - Room {{ $reservation->room->room_number ?? 'N/A' }}
                                - ₱{{ number_format($reservation->final_amount, 2) }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Final Amount</label>

                    <input type="number"
                           id="total_amount"
                           class="form-control"
                           readonly>

                </div>

                <div class="mb-3">

                    <label>Amount Paid</label>

                    <input type="number"
                           name="amount_paid"
                           id="amount_paid"
                           class="form-control"
                           min="0"
                           step="0.01"
                           required>

                </div>

                <div class="mb-3">

                    <label>Balance</label>

                    <input type="number"
                           id="balance"
                           class="form-control"
                           readonly>

                </div>

                <div class="mb-3">

                    <label>Payment Method</label>

                    <select name="payment_method"
                            class="form-control"
                            required>

                        <option value="">Select Method</option>

                        <option value="Cash">Cash</option>
                        <option value="GCash">GCash</option>
                        <option value="Maya">Maya</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Bank Transfer">Bank Transfer</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Reference Number</label>

                    <input type="text"
                           name="reference_number"
                           class="form-control"
                           placeholder="Optional for Cash">

                </div>

                <button class="btn btn-primary">
                    Save Payment
                </button>

            </form>

        </div>

    </div>

</div>

<script>

    const reservationSelect = document.getElementById('reservation_id');
    const totalAmountInput = document.getElementById('total_amount');
    const amountPaidInput = document.getElementById('amount_paid');
    const balanceInput = document.getElementById('balance');

    function updatePaymentDetails() {

        const selectedReservation =
            reservationSelect.options[reservationSelect.selectedIndex];

        const total =
            parseFloat(selectedReservation.getAttribute('data-total')) || 0;

        const paid =
            parseFloat(amountPaidInput.value) || 0;

        const balance =
            Math.max(total - paid, 0);

        totalAmountInput.value = total.toFixed(2);
        balanceInput.value = balance.toFixed(2);
    }

    reservationSelect.addEventListener('change', updatePaymentDetails);
    amountPaidInput.addEventListener('input', updatePaymentDetails);

</script>

</x-app-layout>