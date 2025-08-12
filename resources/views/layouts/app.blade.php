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
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-primary/80 backdrop-blur-md border-r border-light-blue/20 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-glow">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 border-b border-light-blue/20">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-white">Startpoint</h1>
                </div>
                <!-- Mobile close button -->
                <button id="sidebarClose" class="lg:hidden text-white hover:text-accent transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-6 py-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-white rounded-xl hover:bg-light-blue/20 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-light-blue/30 text-accent shadow-glow' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    Dashboard
                </a>

                <!-- Opportunities -->
                <a href="{{ route('opportunities.index') }}" class="flex items-center px-3 py-2 text-white rounded-xl hover:bg-light-blue/20 transition-colors duration-200 {{ request()->routeIs('opportunities.*') ? 'bg-light-blue/30 text-accent shadow-glow' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                    </svg>
                    Opportunities
                </a>

                <!-- Applications -->
                <a href="{{ route('applications.index') }}" class="flex items-center px-3 py-2 text-white rounded-xl hover:bg-light-blue/20 transition-colors duration-200 {{ request()->routeIs('applications.*') ? 'bg-light-blue/30 text-accent shadow-glow' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Applications
                </a>

                <!-- Assignments -->
                <a href="{{ route('assignments.index') }}" class="flex items-center px-3 py-2 text-white rounded-xl hover:bg-light-blue/20 transition-colors duration-200 {{ request()->routeIs('assignments.*') ? 'bg-light-blue/30 text-accent shadow-glow' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Assignments
                </a>

                <!-- Progress Reports -->
                <a href="{{ route('progress-reports.index') }}" class="flex items-center px-3 py-2 text-white rounded-xl hover:bg-light-blue/20 transition-colors duration-200 {{ request()->routeIs('progress-reports.*') ? 'bg-light-blue/30 text-accent shadow-glow' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Progress Reports
                </a>

                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isHrOfficer()))
                <!-- Admin/HR Section -->
                <div class="pt-4">
                    <h3 class="px-3 text-xs font-semibold text-light-blue uppercase tracking-wider">Administration</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('reports.index') }}" class="flex items-center px-3 py-2 text-white rounded-xl hover:bg-light-blue/20 transition-colors duration-200 {{ request()->routeIs('reports.*') ? 'bg-light-blue/30 text-accent shadow-glow' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Reports
                        </a>
                        <a href="{{ route('analytics.index') }}" class="flex items-center px-3 py-2 text-white rounded-xl hover:bg-light-blue/20 transition-colors duration-200 {{ request()->routeIs('analytics.*') ? 'bg-light-blue/30 text-accent shadow-glow' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Analytics
                        </a>
                    </div>
                </div>
                @endif

                @if(auth()->check() && auth()->user()->isHrOfficer())
                <!-- HR Section -->
                <div class="pt-4">
                    <h3 class="px-3 text-xs font-semibold text-light-blue uppercase tracking-wider">HR Management</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('interns.index') }}" class="flex items-center px-3 py-2 text-white rounded-xl hover:bg-light-blue/20 transition-colors duration-200 {{ request()->routeIs('interns.index') ? 'bg-light-blue/30 text-accent shadow-glow' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Interns
                        </a>
                    </div>
                </div>
                @endif
            </nav>

            <!-- User Profile Section -->
            @if(auth()->check())
            <div class="px-6 py-4 border-t border-light-blue/20">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center shadow-glow-orange">
                            <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                        <p class="text-xs text-light-blue capitalize">{{ auth()->user()->user_type }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Top Navigation Bar -->
            <header class="bg-primary/80 backdrop-blur-md border-b border-light-blue/20 shadow-glow">
                <div class="flex items-center justify-between h-16 px-6">
                    <!-- Mobile menu button -->
                    <button id="sidebarToggle" class="lg:hidden text-white hover:text-accent transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <h2 class="text-xl font-semibold text-white">{{ $header ?? 'Dashboard' }}</h2>

                    <!-- Right side actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle Button -->
                        <button id="darkModeToggle" class="p-2 rounded-xl bg-light-blue/20 text-white hover:bg-light-blue/30 focus:outline-none focus:ring-2 focus:ring-accent transition-all duration-300 shadow-glow">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path id="moonIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                <path id="sunIcon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h1M3 12H2m15.325-4.757l-.707-.707M6.343 17.657l-.707.707M16.95 18.364l.707.707M7.05 5.636l-.707-.707"></path>
                            </svg>
                        </button>

                        <!-- Notifications -->
                        <button class="text-white hover:text-accent relative transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M9 11h.01M9 8h.01M9 5h.01M9 2h.01"></path>
                            </svg>
                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-accent rounded-full shadow-glow-orange"></span>
                        </button>

                        <!-- Profile dropdown -->
                        @if(auth()->check())
                        <div class="relative">
                            <button id="profileDropdown" class="flex items-center text-white hover:text-accent focus:outline-none transition-colors">
                                <span class="mr-2">{{ auth()->user()->first_name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown menu -->
                            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-primary/90 backdrop-blur-md rounded-xl shadow-glow border border-light-blue/20 py-2">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-light-blue/20 transition-colors duration-200">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-light-blue/20 transition-colors duration-200">Logout</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                    </div>
                </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden"></div>

    <script>
        // Dark mode toggle logic
        const darkModeToggle = document.getElementById('darkModeToggle');
        const htmlElement = document.documentElement;
        const moonIcon = document.getElementById('moonIcon');
        const sunIcon = document.getElementById('sunIcon');

        // Check local storage for theme preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
            moonIcon.classList.add('hidden');
            sunIcon.classList.remove('hidden');
        } else {
            htmlElement.classList.remove('dark');
            moonIcon.classList.remove('hidden');
            sunIcon.classList.add('hidden');
        }

        darkModeToggle.addEventListener('click', () => {
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.theme = 'light';
                moonIcon.classList.remove('hidden');
                sunIcon.classList.add('hidden');
            } else {
                htmlElement.classList.add('dark');
                localStorage.theme = 'dark';
                moonIcon.classList.add('hidden');
                sunIcon.classList.remove('hidden');
            }
        });

        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });

        sidebarClose.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // Profile dropdown
        const profileDropdown = document.getElementById('profileDropdown');
        const profileMenu = document.getElementById('profileMenu');

        if (profileDropdown && profileMenu) {
            profileDropdown.addEventListener('click', () => {
                profileMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!profileDropdown.contains(e.target)) {
                    profileMenu.classList.add('hidden');
                }
            });
        }
    </script>
    </body>
</html>