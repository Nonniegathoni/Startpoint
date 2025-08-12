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
    <!-- Navigation -->
    <nav class="bg-primary/80 backdrop-blur-md border-b border-light-blue/20 shadow-glow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center shadow-glow-orange">
                            <span class="text-white font-bold text-lg">S</span>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-white">Startpoint</h1>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-white hover:text-accent transition-colors duration-200">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-accent transition-colors duration-200">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-accent to-orange-corrected text-white font-medium rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Build Your Next Big Thing with 
                    <span class="text-gradient">Startpoint</span>
                </h1>
                <p class="text-xl text-light-blue mb-8 max-w-3xl mx-auto">
                    Our platform provides all the tools you need to turn your internship journey into a reality. 
                    Join us and start building your future today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                            Get Started
                        </a>
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-light-blue/10 text-white font-semibold rounded-xl hover:bg-light-blue/20 transition-all duration-300 border border-light-blue/20">
                            Learn More
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 bg-primary/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Why Choose Startpoint?</h2>
                <p class="text-lg text-light-blue max-w-2xl mx-auto">
                    We provide a comprehensive platform designed to streamline your internship experience
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-8 shadow-glow hover:shadow-glow-strong transition-all duration-300">
                    <div class="w-16 h-16 rounded-xl bg-accent/20 flex items-center justify-center mb-6 mx-auto shadow-glow-orange">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4 text-center">Find Opportunities</h3>
                    <p class="text-light-blue text-center">
                        Discover exciting internship opportunities that match your skills and career goals
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-8 shadow-glow hover:shadow-glow-strong transition-all duration-300">
                    <div class="w-16 h-16 rounded-xl bg-light-blue/20 flex items-center justify-center mb-6 mx-auto shadow-glow">
                        <svg class="w-8 h-8 text-light-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4 text-center">Easy Applications</h3>
                    <p class="text-light-blue text-center">
                        Submit applications with our streamlined process and track your progress
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-8 shadow-glow hover:shadow-glow-strong transition-all duration-300">
                    <div class="w-16 h-16 rounded-xl bg-medium-blue-purple/20 flex items-center justify-center mb-6 mx-auto shadow-glow">
                        <svg class="w-8 h-8 text-medium-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4 text-center">Track Progress</h3>
                    <p class="text-light-blue text-center">
                        Monitor your internship journey with comprehensive progress tracking
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Get Started?</h2>
            <p class="text-lg text-light-blue mb-8 max-w-2xl mx-auto">
                Join thousands of students who have already discovered their dream internships through Startpoint
            </p>
            @auth
                <a href="{{ route('dashboard') }}" class="inline-flex px-8 py-4 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                    Go to Dashboard
                </a>
            @else
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="inline-flex px-8 py-4 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                        Create Account
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex px-8 py-4 bg-light-blue/10 text-white font-semibold rounded-xl hover:bg-light-blue/20 transition-all duration-300 border border-light-blue/20">
                        Sign In
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary/80 backdrop-blur-md border-t border-light-blue/20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center shadow-glow-orange">
                            <span class="text-white font-bold text-lg">S</span>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-xl font-bold text-white">Startpoint</h3>
                        </div>
                    </div>
                    <p class="text-light-blue mb-4">
                        Empowering students to find and excel in their dream internships through our comprehensive platform.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-light-blue hover:text-accent transition-colors duration-200">About Us</a></li>
                        <li><a href="#" class="text-light-blue hover:text-accent transition-colors duration-200">Contact</a></li>
                        <li><a href="#" class="text-light-blue hover:text-accent transition-colors duration-200">Support</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-light-blue hover:text-accent transition-colors duration-200">Privacy Policy</a></li>
                        <li><a href="#" class="text-light-blue hover:text-accent transition-colors duration-200">Terms of Service</a></li>
                        <li><a href="#" class="text-light-blue hover:text-accent transition-colors duration-200">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-light-blue/20 mt-8 pt-8 text-center">
                <p class="text-light-blue">
                    &copy; {{ date('Y') }} Startpoint. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>