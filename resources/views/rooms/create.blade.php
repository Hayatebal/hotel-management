<x-app-layout>

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">
            Add Room
        </div>

        <div class="card-body">

            <form action="{{ route('rooms.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Room Number</label>

                    <input type="text"
                           name="room_number"
                           class="form-control"
                           placeholder="Enter Room Number"
                           required>
                </div>

                <div class="mb-3">
                    <label>Room Type</label>

                    <select name="room_type"
                            class="form-control"
                            required>

                        <option value="">Select Room Type</option>

                        <option value="Single">Single</option>
                        <option value="Double">Double</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Suite">Suite</option>
                        <option value="Family">Family</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label>Price Per Hour</label>

                    <input type="number"
                           step="0.01"
                           name="price_per_hour"
                           class="form-control"
                           placeholder="Enter Price Per Hour"
                           required>
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status"
                            class="form-control"
                            required>

                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="reserved">Reserved</option>
                        <option value="maintenance">Maintenance</option>

                    </select>
                </div>

                <button class="btn btn-primary">
                    Save Room
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>