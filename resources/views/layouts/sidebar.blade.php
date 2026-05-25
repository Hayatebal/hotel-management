<div class="min-h-screen flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gradient-to-b from-purple-700 to-indigo-800 text-white shadow-lg">

        <div class="p-6 text-xl font-bold border-b border-purple-500">
            Hotel Admin
        </div>

        <nav class="mt-6">

            <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-purple-600">
                Dashboard
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-purple-600">
                Rooms
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-purple-600">
                Reservations
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-purple-600">
                Payments
            </a>

            <a href="{{ route('profile.edit') }}" class="block px-6 py-3 hover:bg-purple-600">
                Profile
            </a>

        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 bg-gray-50">
        {{ $slot }}
    </div>

</div>