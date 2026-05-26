<x-app-layout>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-purple">Rooms</h2>

        <a href="{{ route('rooms.create') }}" class="btn btn-primary">
            + Add Room
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>Room Number</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($rooms as $room)

                    <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->room_type }}</td>
                        <td>₱{{ number_format($room->price_per_hour, 2) }}</td>

                        <td>
                            @if($room->status == 'available')
                                <span class="badge bg-success">Available</span>
                            @elseif($room->status == 'occupied')
                                <span class="badge bg-danger">Occupied</span>
                            @else
                                <span class="badge bg-warning">Reserved</span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('rooms.edit', $room->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('rooms.destroy', $room->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this room?')">
                                    Delete
                                </button>

                            </form>

                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No rooms found.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

</x-app-layout>