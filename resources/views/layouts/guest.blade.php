<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased h-full bg-gradient-to-br from-dark-blue-purple via-medium-blue-purple to-primary">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Logo -->
        <div class="mb-8">
            <a href="{{ route('welcome') }}" class="flex items-center">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center shadow-glow-orange">
                    <span class="text-white font-bold text-2xl">S</span>
                </div>
                <div class="ml-4">
                    <h1 class="text-3xl font-bold text-white">Startpoint</h1>
                    <p class="text-light-blue text-sm">Internship Management</p>
                </div>
            </a>
        </div>

        <!-- Main Content -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-primary/60 backdrop-blur-md shadow-glow rounded-2xl border border-light-blue/20">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-light-blue text-sm">
                &copy; {{ date('Y') }} Startpoint. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
