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
                    <input type="datetime-local"
                           name="check_in"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Duration Hours</label>
                    <select name="duration_hours"
                            id="duration_hours"
                            class="form-control"
                            required>
                        <option value="">Select Duration</option>
                        <option value="3">3 Hours</option>
                        <option value="6">6 Hours</option>
                        <option value="8">8 Hours</option>
                        <option value="12">12 Hours</option>
                        <option value="24">24 Hours</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Estimated Amount</label>
                    <input type="number"
                           name="final_amount"
                           id="final_amount"
                           class="form-control"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="checked_in">Checked In</option>
                    </select>
                </div>

                <button class="btn btn-primary">
                    Save Reservation
                </button>
            </form>
        </div>
    </div>

</div>

<script>
    const roomSelect = document.getElementById('room_id');
    const durationInput = document.getElementById('duration_hours');
    const finalInput = document.getElementById('final_amount');

    function calculateAmount() {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];

        const price = parseFloat(selectedRoom.getAttribute('data-price')) || 0;
        const duration = parseInt(durationInput.value) || 0;

        const estimatedAmount = price * duration;

        finalInput.value = estimatedAmount.toFixed(2);
    }

    roomSelect.addEventListener('change', calculateAmount);
    durationInput.addEventListener('change', calculateAmount);
</script>
</x-app-layout>