<x-app-layout>
<div class="container py-4">

    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            Add Reservation
        </div>

        <div class="card-body">
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Guest</label>
                    <select name="guest_id" class="form-control" required>
                        <option value="">Select Guest</option>
                        @foreach($guests as $guest)
                            <option value="{{ $guest->id }}">
                                {{ $guest->first_name }} {{ $guest->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Room</label>
                    <select name="room_id" id="room_id" class="form-control" required>
                        <option value="">Select Room</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}"
                                    data-price="{{ $room->price_per_hour }}">
                                Room {{ $room->room_number }}
                                - {{ $room->room_type }}
                                - ₱{{ number_format($room->price_per_hour, 2) }}/hr
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Check In</label>
                    <input type="datetime-local" name="check_in" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Duration Hours</label>
                    <input type="number" name="duration_hours" id="duration_hours" class="form-control" min="1" value="1" required>
                </div>

                <div class="mb-3">
                    <label>Price Per Hour</label>
                    <input type="number" name="price_per_hour" id="price_per_hour" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Total Amount</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Extended Hours</label>
                    <input type="number" name="extended_hours" id="extended_hours" value="0" min="0" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Added Amount</label>
                    <input type="number" name="extended_amount" id="extended_amount" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Final Amount</label>
                    <input type="number" name="final_amount" id="final_amount" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="checked_in">Checked In</option>
                    </select>
                </div>

                <button class="btn btn-primary">Save Reservation</button>
            </form>
        </div>
    </div>

</div>

<script>
    const roomSelect = document.getElementById('room_id');
    const durationInput = document.getElementById('duration_hours');
    const extendedInput = document.getElementById('extended_hours');

    const priceInput = document.getElementById('price_per_hour');
    const totalInput = document.getElementById('total_amount');
    const extendedAmountInput = document.getElementById('extended_amount');
    const finalInput = document.getElementById('final_amount');

    function calculateAmount() {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const price = parseFloat(selectedRoom.getAttribute('data-price')) || 0;
        const duration = parseInt(durationInput.value) || 0;
        const extended = parseInt(extendedInput.value) || 0;

        const total = price * duration;
        const extendedAmount = price * extended;
        const finalAmount = total + extendedAmount;

        priceInput.value = price.toFixed(2);
        totalInput.value = total.toFixed(2);
        extendedAmountInput.value = extendedAmount.toFixed(2);
        finalInput.value = finalAmount.toFixed(2);
    }

    roomSelect.addEventListener('change', calculateAmount);
    durationInput.addEventListener('input', calculateAmount);
    extendedInput.addEventListener('input', calculateAmount);
</script>
</x-app-layout>