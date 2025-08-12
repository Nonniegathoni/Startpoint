<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-white mb-2">Welcome Back!</h2>
            <p class="text-light-blue">Sign in to your account to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-white mb-2">Email Address</label>
                <input id="email" class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl" 
                       type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                       placeholder="Enter your email address">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
                <input id="password" class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl"
                       type="password" name="password" required autocomplete="current-password"
                       placeholder="Enter your password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" 
                           class="rounded border-light-blue/20 text-accent focus:ring-accent bg-light-blue/10">
                    <span class="ml-2 text-sm text-light-blue">Remember me</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="text-sm text-accent hover:text-orange-corrected transition-colors duration-200" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                    Sign In
                </button>
            </div>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-light-blue/20"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-primary/60 text-light-blue">Or continue with</span>
                </div>
            </div>

            <!-- Social Login -->
            <div class="grid grid-cols-2 gap-3">
                <button type="button" 
                        class="w-full inline-flex justify-center py-2 px-4 bg-light-blue/10 text-white font-medium rounded-xl hover:bg-light-blue/20 transition-all duration-300 border border-light-blue/20">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </button>

                <button type="button" 
                        class="w-full inline-flex justify-center py-2 px-4 bg-light-blue/10 text-white font-medium rounded-xl hover:bg-light-blue/20 transition-all duration-300 border border-light-blue/20">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-sm text-light-blue">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-accent hover:text-orange-corrected transition-colors duration-200 font-medium">
                        Sign up here
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
