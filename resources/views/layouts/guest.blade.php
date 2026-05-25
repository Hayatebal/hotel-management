<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>La Luna Hotel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-950 via-purple-800 to-indigo-700 px-6">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-white" />
                </a>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-2xl px-8 py-10">

                <!-- Title -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-purple-800">
                        Hotel Management
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Welcome back to your system
                    </p>
                </div>

                {{ $slot }}

            </div>

        </div>

    </div>

</body>

</html>