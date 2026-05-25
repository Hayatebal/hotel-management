<!DOCTYPE html>
<html>
<head>
    <title>La Luna Hotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f3ff;
        }

        .navbar {
            background: linear-gradient(90deg, #6a0dad, #8a2be2);
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #6a0dad, #4c1d95);
            color: white;
            padding: 20px;
        }

        .sidebar a {
            color: #eee;
            display: block;
            padding: 10px 12px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover {
            background: #8a2be2;
            color: white;
        }

        .content {
            min-height: 100vh;
            padding: 20px;
            background-color: #f5f3ff;
        }

        .dropdown-toggle {
            background-color: white;
            color: #6a0dad;
            font-weight: bold;
            border: none;
            border-radius: 20px;
            padding: 6px 16px;
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="container-fluid d-flex justify-content-between">
        <span class="navbar-brand">🏨 Hotel Management</span>

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
                                🚪 Logout
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

            <a href="{{ route('dashboard') }}">📊 Dashboard</a>
            <a href="{{ route('rooms.index') }}">🛏 Rooms</a>
            <a href="{{ route('guests.index') }}">👥 Guests</a>
            <a href="{{ route('reservations.index') }}">📅 Reservations</a>
            <a href="{{ route('payments.index') }}">💰 Payments</a>
        </div>

        <div class="col-md-10 content">
            {{ $slot }}
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>