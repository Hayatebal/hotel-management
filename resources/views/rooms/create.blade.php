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
                           required>
                </div>

                <div class="mb-3">
                    <label>Room Type</label>

                    <input type="text"
                           name="type"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Price</label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="reserved">Reserved</option>

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