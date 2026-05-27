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
                        <th>Estimated Amount</th>
                        <th>Status</th>
                        <th width="280">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($reservations as $reservation)

                        <tr>

                            <td>
                                {{ $reservation->guest->first_name ?? '' }}
                                {{ $reservation->guest->last_name ?? '' }}
                            </td>

                            <td>
                                Room {{ $reservation->room->room_number ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $reservation->check_in }}
                            </td>

                            <td>
                                {{ $reservation->check_out ?? 'N/A' }}
                            </td>

                            <td>
                                ₱{{ number_format($reservation->final_amount ?? 0, 2) }}
                            </td>

                            <td>

                                @if($reservation->status == 'pending')
                                    <span class="badge bg-secondary">
                                        Pending
                                    </span>

                                @elseif($reservation->status == 'reserved')
                                    <span class="badge bg-warning">
                                        Reserved
                                    </span>

                                @elseif($reservation->status == 'checked_in')
                                    <span class="badge bg-primary">
                                        Checked In
                                    </span>

                                @elseif($reservation->status == 'checked_out')
                                    <span class="badge bg-success">
                                        Checked Out
                                    </span>

                                @else
                                    <span class="badge bg-danger">
                                        Cancelled
                                    </span>
                                @endif

                            </td>

                            <td>

                              {{-- CHECK-IN RECEIPT --}}
                                @if(in_array($reservation->status, ['checked_in', 'checked_out']))

                                    <a href="{{ route('reservations.checkinReceipt', $reservation->id) }}"
                                       class="btn btn-success btn-sm mb-1">

                                        Print

                                    </a>

                                @endif

                                <a href="{{ route('reservations.edit', $reservation) }}"
                                   class="btn btn-warning btn-sm mb-1">
                                    Edit
                                </a>

                                <form action="{{ route('reservations.destroy', $reservation) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Delete this reservation?')"
                                            class="btn btn-danger btn-sm mb-1">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center">
                                No reservations found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>
</x-app-layout>