<x-app-layout>

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-warning">
            Edit Payment
        </div>

        <div class="card-body">

            <form action="{{ route('payments.update', $payment) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Reservation</label>

                    <select name="reservation_id"
                            id="reservation_id"
                            class="form-control"
                            required>

                        @foreach($reservations as $reservation)

                            <option value="{{ $reservation->id }}"
                                    data-total="{{ $reservation->final_amount }}"
                                    {{ $payment->reservation_id == $reservation->id ? 'selected' : '' }}>

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
                           value="{{ $payment->amount_paid }}"
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

                        <option value="Cash" {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        <option value="GCash" {{ $payment->payment_method == 'GCash' ? 'selected' : '' }}>
                            GCash
                        </option>

                        <option value="Maya" {{ $payment->payment_method == 'Maya' ? 'selected' : '' }}>
                            Maya
                        </option>

                        <option value="Credit Card" {{ $payment->payment_method == 'Credit Card' ? 'selected' : '' }}>
                            Credit Card
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Reference Number</label>

                    <input type="text"
                           name="reference_number"
                           value="{{ $payment->reference_number }}"
                           class="form-control">

                </div>

                <button class="btn btn-warning">
                    Update Payment
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

    updatePaymentDetails();

</script>

</x-app-layout>