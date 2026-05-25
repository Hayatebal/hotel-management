@php
    $totalRooms = \App\Models\Room::count();
    $availableRooms = \App\Models\Room::where('status', 'available')->count();
    $occupiedRooms = \App\Models\Room::where('status', 'occupied')->count();
    $reservedRooms = \App\Models\Room::where('status', 'reserved')->count();

    $totalGuests = \App\Models\Guest::count();

    $totalReservations = \App\Models\Reservation::count();
    $checkedIn = \App\Models\Reservation::where('status', 'checked_in')->count();
    $checkedOut = \App\Models\Reservation::where('status', 'checked_out')->count();

    $totalPayments = \App\Models\Payment::count();
    $revenue = \App\Models\Payment::sum('amount_paid');
@endphp

<x-app-layout>

<div class="container py-4">

    <h2 class="fw-bold mb-4" style="color:#6a0dad;">
        Hotel Dashboard
    </h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow border-0 border-start border-5 border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Total Rooms</h6>
                    <h2 class="fw-bold text-primary">{{ $totalRooms }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 border-start border-5 border-success">
                <div class="card-body">
                    <h6 class="text-muted">Available Rooms</h6>
                    <h2 class="fw-bold text-success">{{ $availableRooms }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 border-start border-5 border-danger">
                <div class="card-body">
                    <h6 class="text-muted">Occupied Rooms</h6>
                    <h2 class="fw-bold text-danger">{{ $occupiedRooms }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 border-start border-5 border-info">
                <div class="card-body">
                    <h6 class="text-muted">Guests</h6>
                    <h2 class="fw-bold text-info">{{ $totalGuests }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 border-start border-5 border-warning">
                <div class="card-body">
                    <h6 class="text-muted">Reservations</h6>
                    <h2 class="fw-bold text-warning">{{ $totalReservations }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 text-white" style="background: linear-gradient(90deg,#6a0dad,#8a2be2);">
                <div class="card-body">
                    <h6>Revenue</h6>
                    <h2 class="fw-bold">₱{{ number_format($revenue, 2) }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-4">

        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="fw-bold mb-3" style="color:#6a0dad;">
                        Room Status
                    </h5>
                    <canvas id="roomChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="fw-bold mb-3" style="color:#6a0dad;">
                        Reservation Status
                    </h5>
                    <canvas id="reservationChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-4">

        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="fw-bold mb-3" style="color:#6a0dad;">
                        Revenue Chart
                    </h5>
                    <canvas id="revenueChart" height="90"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let availableRooms = {{ $availableRooms }};
    let occupiedRooms = {{ $occupiedRooms }};
    let reservedRooms = {{ $reservedRooms }};

    let checkedIn = {{ $checkedIn }};
    let checkedOut = {{ $checkedOut }};
    let pendingReservations = {{ \App\Models\Reservation::where('status', 'pending')->count() }};

    let revenue = {{ $revenue }};

    new Chart(document.getElementById('roomChart'), {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Occupied', 'Reserved'],
            datasets: [{
                data: [availableRooms, occupiedRooms, reservedRooms],
                backgroundColor: ['#22C55E', '#EF4444', '#8B5CF6']
            }]
        }
    });

    new Chart(document.getElementById('reservationChart'), {
        type: 'doughnut',
        data: {
            labels: ['Checked In', 'Checked Out', 'Pending'],
            datasets: [{
                data: [checkedIn, checkedOut, pendingReservations],
                backgroundColor: ['#3B82F6', '#22C55E', '#F59E0B']
            }]
        }
    });

    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: ['Total Revenue'],
            datasets: [{
                label: 'Income',
                data: [revenue],
                backgroundColor: '#7C3AED'
            }]
        }
    });
</script>

</x-app-layout>