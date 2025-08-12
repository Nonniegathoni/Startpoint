<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-900 via-indigo-900 to-blue-900 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 p-4">
        <!-- Dark Mode Toggle -->
        <div class="absolute top-4 right-4">
            <button id="darkModeToggle" class="p-3 rounded-full bg-white/10 text-white hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-purple-400 backdrop-blur-sm transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path id="moonIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    <path id="sunIcon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h1M3 12H2m15.325-4.757l-.707-.707M6.343 17.657l-.707.707M16.95 18.364l.707.707M7.05 5.636l-.707-.707"></path>
                </svg>
            </button>
        </div>

        <div class="w-full max-w-md">
            <!-- Logo/Title Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">Startpoint</h1>
                <p class="text-purple-200 dark:text-gray-300">Internship Management System</p>
            </div>

            <!-- Forgot Password Form Card -->
            <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 p-8">
                <h2 class="text-2xl font-bold text-white text-center mb-6">Reset Password</h2>
                
                <div class="text-center mb-6">
                    <p class="text-purple-200 dark:text-gray-300">
                        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                    </p>
                </div>

                <!-- Session Status -->
                <div class="mb-4 text-sm text-purple-200 dark:text-gray-300">
                    {{ session('status') }}
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" value="Email" class="text-purple-200 dark:text-gray-300" />
                        <x-text-input id="email" class="block mt-2 w-full bg-white/10 border-white/20 text-white placeholder-purple-200 dark:placeholder-gray-400 focus:border-purple-400 focus:ring-purple-400 rounded-xl" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email address" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <x-primary-button class="w-full justify-center bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 border-0 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            Email Password Reset Link
                        </x-primary-button>
                    </div>

                    <!-- Back to Login -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-purple-300 hover:text-purple-200 dark:text-purple-400 dark:hover:text-purple-300 font-semibold transition-colors duration-200">
                            ← Back to Login
                        </a>
                    </div>
                </form>
            </div>
        </div>

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
        </script>
    </div>
</x-guest-layout>
