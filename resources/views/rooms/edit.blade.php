<x-app-layout>

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-warning">
            Edit Room
        </div>

        <div class="card-body">

            <form action="{{ route('rooms.update', $room->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Room Number</label>

                    <input type="text"
                           name="room_number"
                           value="{{ $room->room_number }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Select Room Type</label>

                    <select name="room_type" class="form-control">
                        <option value="single" {{ $room->room_type == 'single' ? 'selected' : '' }}>
                            Single
                        </option>
                        <option value="double" {{ $room->room_type == 'double' ? 'selected' : '' }}>
                            Double
                        </option>

                        <option value="double" {{ $room->room_type == 'deluxe' ? 'selected' : '' }}>
                            Deluxe
                        </option>

                        <option value="suite" {{ $room->room_type == 'suite' ? 'selected' : '' }}>
                            Suite
                        </option>

                        <option value="double" {{ $room->room_type == 'family' ? 'selected' : '' }}>
                            Family
                        </option>
                    </select>
                </div>
                           required>
                </div>

                <div class="mb-3">
                    <label>Price per Hour</label>

                    <input type="number"
                           step="0.01"
                           name="price_per_hour"
                           value="{{ $room->price_per_hour }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>
                            Available
                        </option>

                        <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>
                            Occupied
                        </option>

                        <option value="reserved" {{ $room->status == 'reserved' ? 'selected' : '' }}>
                            Reserved
                        </option>

                        <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>
                            Maintenance
                        </option>

                    </select>
                </div>

                <button class="btn btn-warning">
                    Update Room
                </button>

            </form>

        </div>
    </div>

</div>

</x-app-layout>