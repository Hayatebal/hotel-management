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
                    <label>Room Type</label>

                    <input type="text"
                           name="type"
                           value="{{ $room->type }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Price</label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           value="{{ $room->price }}"
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