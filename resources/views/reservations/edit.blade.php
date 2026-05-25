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
                                {{ $guest->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Room</label>
                    <select name="room_id" id="room_id" class="form-control" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}"
                                data-price-3hrs="{{ $room->price_3hrs ?? 0 }}"
                                data-price-6hrs="{{ $room->price_6hrs ?? 0 }}"
                                data-price-8hrs="{{ $room->price_8hrs ?? 0 }}"
                                data-price-12hrs="{{ $room->price_12hrs ?? 0 }}"
                                data-price-24hrs="{{ $room->price_24hrs ?? 0 }}"
                                data-overtime-fee="{{ $room->overtime_fee_per_hour ?? 0 }}"
                                {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                                Room {{ $room->room_number }} - {{ $room->room_type ?? $room->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Check In</label>
                    <input type="datetime-local"
                           name="check_in"
                           value="{{ date('Y-m-d\TH:i', strtotime($reservation->check_in)) }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Duration</label>
                    <select name="duration_type" id="duration_type" class="form-control" required>
                        <option value="3hrs" {{ $reservation->duration_type == '3hrs' ? 'selected' : '' }}>3 Hours</option>
                        <option value="6hrs" {{ $reservation->duration_type == '6hrs' ? 'selected' : '' }}>6 Hours</option>
                        <option value="8hrs" {{ $reservation->duration_type == '8hrs' ? 'selected' : '' }}>8 Hours</option>
                        <option value="12hrs" {{ $reservation->duration_type == '12hrs' ? 'selected' : '' }}>12 Hours</option>
                        <option value="24hrs" {{ $reservation->duration_type == '24hrs' ? 'selected' : '' }}>24 Hours</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Total Amount</label>
                    <input type="number" name="total_amount" id="total_amount" value="{{ $reservation->total_amount }}" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Extended Hours</label>
                    <input type="number" name="extended_hours" id="extended_hours" value="{{ $reservation->extended_hours ?? 0 }}" min="0" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Final Amount</label>
                    <input type="number" id="final_amount" value="{{ $reservation->final_amount }}" class="form-control" readonly>
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

                <button class="btn btn-warning">Update Reservation</button>
            </form>
        </div>
    </div>

</div>

<script>
    const roomSelect = document.getElementById('room_id');
    const durationSelect = document.getElementById('duration_type');
    const totalAmount = document.getElementById('total_amount');
    const extendedHours = document.getElementById('extended_hours');
    const finalAmount = document.getElementById('final_amount');

    function updateAmount() {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const duration = durationSelect.value;

        const price = parseFloat(selectedRoom.getAttribute('data-price-' + duration)) || 0;
        const overtimeFee = parseFloat(selectedRoom.getAttribute('data-overtime-fee')) || 0;
        const hours = parseInt(extendedHours.value) || 0;

        const finalTotal = price + (hours * overtimeFee);

        totalAmount.value = price.toFixed(2);
        finalAmount.value = finalTotal.toFixed(2);
    }

    roomSelect.addEventListener('change', updateAmount);
    durationSelect.addEventListener('change', updateAmount);
    extendedHours.addEventListener('input', updateAmount);
</script>
</x-app-layout>