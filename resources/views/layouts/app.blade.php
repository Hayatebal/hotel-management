<!DOCTYPE html>
<html>
<head>
    <title>La Luna Hotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>

        body {
            background:
                linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
                url('{{ asset('images/pngtree-abstract-blur-hotel-lobby-picture-image_15505805.jpg') }}');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

            min-height: 100vh;
            overflow-x: hidden;
        }

        /* NAVBAR */

        .navbar {
            background: #ff8800;
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 9999;
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 36px;
        }

        /* PROFILE BUTTON */

        .dropdown-toggle {
            background: white;
            color: #ff8800;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            padding: 10px 18px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .dropdown-menu {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            overflow: hidden;
            z-index: 99999;
        }

        .dropdown-item {
            padding: 12px 18px;
            font-weight: 500;
        }

        /* SIDEBAR */

        .sidebar {
            min-height: 100vh;
            background: rgba(255, 136, 0, 0.95);
            padding: 25px 20px;
            backdrop-filter: blur(8px);
        }

        .sidebar h5 {
            color: white;
            font-weight: bold;
            margin-bottom: 30px;
            font-size: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        /* CONTENT */

        .content {
            min-height: 100vh;
            padding: 30px;

            background:
                linear-gradient(rgba(255,255,255,0.10),
                rgba(255,255,255,0.10));

            backdrop-filter: blur(6px);
        }

        /* CARDS */

        .card {
            border: none;
            border-radius: 24px;
            overflow: hidden;

            background: rgba(255,255,255,0.92);

            backdrop-filter: blur(12px);

            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        .card-header {
            background: #ff8800 !important;
            color: white !important;
            font-weight: bold;
            border: none;
            padding: 18px 25px;
            font-size: 20px;
        }

        /* TABLE */

        table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
        }

        .table-dark {
            background: #222 !important;
            color: white;
        }

        /* BUTTONS */

        .btn-primary {
            background: #ff8800;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: #e67600;
        }

        .btn-warning {
            color: white;
            font-weight: bold;
        }

        /* BADGES */

        .badge {
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        /* FIX DROPDOWN OVERLAY ISSUE */

        .container-fluid,
        .row,
        .content {
            overflow: visible !important;
        }

    </style>
</head>

<body>

<nav class="navbar">
    <div class="container-fluid d-flex justify-content-between">
        <span class="navbar-brand">Hotel Management</span>

        @auth
            <div class="dropdown">
                <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
                    👤 {{ auth()->user()->name }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            Profile
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar">
            <h5 class="fw-bold mb-4">MENU</h5>

            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('rooms.index') }}">Rooms</a>
            <a href="{{ route('guests.index') }}">Guests</a>
            <a href="{{ route('reservations.index') }}">Reservations</a>
            <a href="{{ route('payments.index') }}">Payments</a>
        </div>

        <div class="col-md-10 content">
            {{ $slot }}
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>