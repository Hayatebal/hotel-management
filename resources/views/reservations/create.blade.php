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
                            <option value="{{ $room->id }}" data-price="{{ $room->price ?? 0 }}">
                                Room {{ $room->room_number }}
                                - {{ $room->room_type ?? $room->type }}
                                - ₱{{ number_format($room->price ?? 0, 2) }}/hour
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
                    <select name="duration_hours" id="duration_hours" class="form-control" required>
                        <option value="">Select Duration</option>
                        <option value="3">3 Hours</option>
                        <option value="6">6 Hours</option>
                        <option value="8">8 Hours</option>
                        <option value="12">12 Hours</option>
                        <option value="24">24 Hours</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Price Per Hour</label>
                    <input type="number" id="price_per_hour" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Total Amount</label>
                    <input type="number" id="total_amount" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Extended Hours</label>
                    <input type="number" name="extended_hours" id="extended_hours" value="0" min="0" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Extended Amount</label>
                    <input type="number" id="extended_amount" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Final Amount</label>
                    <input type="number" id="final_amount" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="checked_in">Checked In</option>
                        <option value="checked_out">Checked Out</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <button class="btn btn-primary">Save Reservation</button>
            </form>
        </div>
    </div>

</div>

<script>
    const roomSelect = document.getElementById('room_id');
    const durationSelect = document.getElementById('duration_hours');
    const extendedHoursInput = document.getElementById('extended_hours');

    const pricePerHourInput = document.getElementById('price_per_hour');
    const totalAmountInput = document.getElementById('total_amount');
    const extendedAmountInput = document.getElementById('extended_amount');
    const finalAmountInput = document.getElementById('final_amount');

    function calculateAmount() {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];

        const pricePerHour = parseFloat(selectedRoom.getAttribute('data-price')) || 0;
        const durationHours = parseInt(durationSelect.value) || 0;
        const extendedHours = parseInt(extendedHoursInput.value) || 0;

        const totalAmount = pricePerHour * durationHours;
        const extendedAmount = pricePerHour * extendedHours;
        const finalAmount = totalAmount + extendedAmount;

        pricePerHourInput.value = pricePerHour.toFixed(2);
        totalAmountInput.value = totalAmount.toFixed(2);
        extendedAmountInput.value = extendedAmount.toFixed(2);
        finalAmountInput.value = finalAmount.toFixed(2);
    }

    roomSelect.addEventListener('change', calculateAmount);
    durationSelect.addEventListener('change', calculateAmount);
    extendedHoursInput.addEventListener('input', calculateAmount);
</script>
</x-app-layout>