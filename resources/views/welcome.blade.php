@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-4 dark:bg-gradient-to-br dark:from-gradient4d dark:via-gradient4b dark:to-gradient4a transition-colors duration-500">
    <div class="absolute top-6 right-6">
        <!-- Dark mode toggle -->
        <button id="theme-toggle" class="bg-gradient4d text-white px-4 py-2 rounded shadow hover:bg-gradient4c transition">
            <span class="hidden dark:inline">🌞 Light Mode</span>
            <span class="inline dark:hidden">🌙 Dark Mode</span>
        </button>
    </div>
    <div class="w-full max-w-2xl text-center px-4 py-24">
        <h1 class="text-4xl md:text-6xl font-extrabold text-gradient4d dark:text-gradient4a leading-tight mb-6 drop-shadow-lg">
            Build Your Next Big Thing with <span class="text-gradient4b">Startpoint</span>
        </h1>
        <p class="mt-2 text-lg md:text-2xl text-gradient4c dark:text-gradient4b max-w-2xl mx-auto mb-10">
            Our platform provides all the tools you need to turn your internship journey into a reality.<br>
            Join us and start building your future today.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
            <a href="{{ route('login') }}" class="px-8 py-3 rounded-md bg-gradient4c hover:bg-gradient4d text-white font-bold shadow-lg transition duration-200">Login</a>
            <a href="{{ route('register') }}" class="px-8 py-3 rounded-md bg-gradient4b hover:bg-gradient4a text-white font-bold shadow-lg transition duration-200">Register</a>
        </div>
    </div>
</div>
<script>
    // Simple dark mode toggle
    document.getElementById('theme-toggle').onclick = function() {
        document.documentElement.classList.toggle('dark');
    };
</script>
@endsection