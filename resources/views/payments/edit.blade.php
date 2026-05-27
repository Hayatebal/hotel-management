<x-app-layout>

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-warning text-white">
            Edit Payment
        </div>

        <div class="card-body">

            <form action="{{ route('payments.update', $payment) }}" method="POST">

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

                                {{ $reservation->guest->first_name ?? '' }}
                                {{ $reservation->guest->last_name ?? '' }}
                                - Room {{ $reservation->room->room_number ?? 'N/A' }}
                                - ₱{{ number_format($reservation->final_amount, 2) }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Final Amount</label>

                    <input type="number"
                           id="final_amount"
                           class="form-control"
                           readonly>

                </div>

                <div class="mb-3">

                    <label>Amount Paid</label>

                    <input type="number"
                           name="amount"
                           id="amount"
                           value="{{ $payment->amount }}"
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

                    <label>Exchange Amount</label>

                    <input type="number"
                           id="exchange_amount"
                           class="form-control"
                           readonly>

                </div>

                <div class="mb-3">

                    <label>Payment Method</label>

                    <select name="payment_method"
                            class="form-control"
                            required>

                        <option value="Cash"
                            {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        <option value="GCash"
                            {{ $payment->payment_method == 'GCash' ? 'selected' : '' }}>
                            GCash
                        </option>

                        <option value="Credit Card"
                            {{ $payment->payment_method == 'Credit Card' ? 'selected' : '' }}>
                            Credit Card
                        </option>

                        <option value="Debit Card"
                            {{ $payment->payment_method == 'Debit Card' ? 'selected' : '' }}>
                            Debit Card
                        </option>

                        <option value="Bank Transfer"
                            {{ $payment->payment_method == 'Bank Transfer' ? 'selected' : '' }}>
                            Bank Transfer
                        </option>

                        <option value="PayPal"
                            {{ $payment->payment_method == 'PayPal' ? 'selected' : '' }}>
                            PayPal
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Reference Number</label>

                    <input type="text"
                           name="reference_number"
                           class="form-control"
                           value="{{ $payment->reference_number }}"
                           readonly>

                </div>

                <div class="mb-3">

                    <label>Status</label>

                    <select name="status"
                            class="form-control"
                            required>

                        <option value="pending"
                            {{ $payment->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="paid"
                            {{ $payment->status == 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>

                    </select>

                </div>

                <button class="btn btn-warning">
                    Update Payment
                </button>

            </form>

        </div>

    </div>

</div>

<script>

    const reservationSelect =
        document.getElementById('reservation_id');

    const finalAmountInput =
        document.getElementById('final_amount');

    const amountInput =
        document.getElementById('amount');

    const balanceInput =
        document.getElementById('balance');

    const exchangeInput =
        document.getElementById('exchange_amount');

    function updatePaymentDetails() {

        const selectedReservation =
            reservationSelect.options[reservationSelect.selectedIndex];

        const finalAmount =
            parseFloat(selectedReservation.getAttribute('data-total')) || 0;

        const paid =
            parseFloat(amountInput.value) || 0;

        let balance = 0;
        let exchange = 0;

        if (paid < finalAmount) {

            balance = finalAmount - paid;
            exchange = 0;

        } else {

            balance = 0;
            exchange = paid - finalAmount;

        }

        finalAmountInput.value =
            finalAmount.toFixed(2);

        balanceInput.value =
            balance.toFixed(2);

        exchangeInput.value =
            exchange.toFixed(2);
    }

    reservationSelect.addEventListener(
        'change',
        updatePaymentDetails
    );

    amountInput.addEventListener(
        'input',
        updatePaymentDetails
    );

    updatePaymentDetails();

</script>

</x-app-layout>