<x-app-layout>
<div class="container py-4">

    <div class="card shadow border-0">
        <div class="card-header bg-warning">
            Edit Reservation
        </div>

        <div class="card-body">
            <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Guest</label>
                    <select name="guest_id" class="form-control" required>
                        @foreach($guests as $guest)
                            <option value="{{ $guest->id }}" {{ $reservation->guest_id == $guest->id ? 'selected' : '' }}>
                                {{ $guest->first_name }} {{ $guest->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Room</label>
                    <select name="room_id" id="room_id" class="form-control" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}"
                                    data-price="{{ $room->price_per_hour }}"
                                    {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                                Room {{ $room->room_number }} - {{ $room->room_type }} - ₱{{ number_format($room->price_per_hour, 2) }}/hr
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Check In</label>

                        <input type="datetime-local"
                               class="form-control"
                               value="{{ \Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d\TH:i') }}"
                               readonly>

                        <input type="hidden"
                               name="check_in"
                               value="{{ $reservation->check_in }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Check Out</label>

                        <input type="datetime-local"
                               name="check_out"
                               id="check_out"
                               class="form-control"
                               value="{{ $reservation->check_out ? \Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Duration Hours</label>

                    <input type="number"
                           class="form-control"
                           value="{{ $reservation->duration_hours }}"
                           readonly>

                    <input type="hidden"
                           name="duration_hours"
                           value="{{ $reservation->duration_hours }}">
                </div>

                <div class="mb-3">
                    <label>Price Per Hour</label>

                    <input type="number"
                           id="price_per_hour"
                           class="form-control"
                           value="{{ $reservation->price_per_hour }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Total Amount</label>

                    <input type="number"
                           id="total_amount"
                           class="form-control"
                           value="{{ $reservation->total_amount }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Extended Time</label>

                    <input type="text"
                           id="extended_display"
                           class="form-control"
                           value="0 Days : 0 Hours : 0 Minutes"
                           readonly>

                    <input type="hidden"
                           name="extended_hours"
                           id="extended_hours"
                           value="{{ $reservation->extended_hours ?? 0 }}">
                </div>

                <div class="mb-3">
                    <label>Final Amount</label>

                    <input type="number"
                           id="final_amount"
                           class="form-control"
                           value="{{ $reservation->final_amount }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control" required>
                        <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="checked_in" {{ $reservation->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                        <option value="checked_out" {{ $reservation->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                        <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <button class="btn btn-warning">
                    Update Reservation
                </button>
            </form>
        </div>
    </div>

</div>

<script>
    const roomSelect = document.getElementById('room_id');
    const checkoutInput = document.getElementById('check_out');

    const extendedHidden = document.getElementById('extended_hours');
    const extendedDisplay = document.getElementById('extended_display');

    const priceInput = document.getElementById('price_per_hour');
    const totalInput = document.getElementById('total_amount');
    const finalInput = document.getElementById('final_amount');

    const checkIn = new Date("{{ \Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d\TH:i') }}");
    const duration = parseInt({{ $reservation->duration_hours }}) || 0;

    function calculateAmount() {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];

        const price = parseFloat(selectedRoom.getAttribute('data-price')) || 0;

        const total = price * duration;

        let extendedHoursDecimal = 0;
        let displayText = "0 Days : 0 Hours : 0 Minutes";

        if (checkoutInput.value) {
            const checkout = new Date(checkoutInput.value);

            const expectedCheckout = new Date(checkIn);
            expectedCheckout.setHours(expectedCheckout.getHours() + duration);

            const diffMs = checkout - expectedCheckout;

            if (diffMs > 0) {
                const totalMinutes = Math.floor(diffMs / 60000);

                const days = Math.floor(totalMinutes / 1440);
                const hours = Math.floor((totalMinutes % 1440) / 60);
                const minutes = totalMinutes % 60;

                extendedHoursDecimal = totalMinutes / 60;

                displayText = `${days} Days : ${hours} Hours : ${minutes} Minutes`;
            }
        }

        const extendedAmount = price * extendedHoursDecimal;
        const finalAmount = total + extendedAmount;

        priceInput.value = price.toFixed(2);
        totalInput.value = total.toFixed(2);
        extendedHidden.value = extendedHoursDecimal.toFixed(2);
        extendedDisplay.value = displayText;
        finalInput.value = finalAmount.toFixed(2);
    }

    roomSelect.addEventListener('change', calculateAmount);
    checkoutInput.addEventListener('input', calculateAmount);
    checkoutInput.addEventListener('change', calculateAmount);

    calculateAmount();
</script>

</x-app-layout>