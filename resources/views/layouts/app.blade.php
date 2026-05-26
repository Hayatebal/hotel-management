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
        }

        /* NAVBAR */

        .navbar {
            background: linear-gradient(90deg, #ff7b00, #ff9500);
            backdrop-filter: blur(5px);

            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 24px;
            letter-spacing: 1px;
        }

        /* SIDEBAR */

        .sidebar {
            min-height: 100vh;

            background: rgba(255, 123, 0, 0.88);

            backdrop-filter: blur(8px);

            color: white;
            padding: 20px;

            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 12px 14px;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.25);
            color: white;
            transform: translateX(5px);
        }

        /* CONTENT */

        .content {
            min-height: 100vh;
            padding: 20px;

            background: rgba(255,255,255,0.12);

            backdrop-filter: blur(8px);
        }

        /* CARDS */

        .card {
            border: none;
            border-radius: 18px;

            background: rgba(255,255,255,0.92);

            backdrop-filter: blur(10px);

            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        }

        .card-header {
            border-top-left-radius: 18px !important;
            border-top-right-radius: 18px !important;

            background: linear-gradient(90deg, #ff7b00, #ff9500) !important;

            color: white !important;

            font-weight: bold;
            font-size: 18px;
        }

        /* BUTTONS */

        .btn-primary {
            background: linear-gradient(90deg, #ff7b00, #ff9500);
            border: none;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #e56f00, #ff8800);
        }

        .btn-warning {
            border-radius: 8px;
        }

        .btn-danger {
            border-radius: 8px;
        }

        /* USER DROPDOWN */

        .dropdown-toggle {
            background-color: white;
            color: #ff7b00;
            font-weight: bold;
            border: none;
            border-radius: 20px;
            padding: 6px 16px;
        }

        /* TABLES */

        table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-dark {
            background: linear-gradient(90deg, #ff7b00, #ff9500);
            color: white;
        }

        /* BADGES */

        .badge.bg-success {
            background-color: #28a745 !important;
        }

        .badge.bg-danger {
            background-color: #dc3545 !important;
        }

        .badge.bg-warning {
            background-color: #ff9500 !important;
            color: white !important;
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