<x-app-layout>
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Reservations</h2>

        <a href="{{ route('reservations.create') }}" class="btn btn-primary">
            + Add Reservation
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Final Amount</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->guest->name ?? 'N/A' }}</td>
                            <td>Room {{ $reservation->room->room_number ?? 'N/A' }}</td>
                            <td>{{ $reservation->check_in }}</td>
                            <td>{{ $reservation->check_out }}</td>
                            <td>₱{{ number_format($reservation->final_amount ?? 0, 2) }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Delete this reservation?')" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No reservations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
</x-app-layout>