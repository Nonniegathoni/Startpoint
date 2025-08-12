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
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-2xl font-bold text-white mb-2">Create Account</h2>
                <p class="text-light-blue">Join Startpoint and start your internship journey</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-white mb-2">First Name</label>
                        <input id="first_name" class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl" 
                               type="text" name="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="given-name" 
                               placeholder="Enter your first name">
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-white mb-2">Last Name</label>
                        <input id="last_name" class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl" 
                               type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name" 
                               placeholder="Enter your last name">
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-white mb-2">Email Address</label>
                    <input id="email" class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl" 
                           type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                           placeholder="Enter your email address">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-white mb-2">Phone Number</label>
                    <input id="phone_number" class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl" 
                           type="tel" name="phone_number" value="{{ old('phone_number') }}" 
                           placeholder="Enter your phone number">
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <!-- User Type -->
                <div>
                    <label for="user_type" class="block text-sm font-medium text-white mb-2">I am a...</label>
                    <select id="user_type" name="user_type" required
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select your role</option>
                        <option value="applicant" {{ old('user_type') == 'applicant' ? 'selected' : '' }}>Student/Applicant</option>
                        <option value="supervisor" {{ old('user_type') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        <option value="hr_officer" {{ old('user_type') == 'hr_officer' ? 'selected' : '' }}>HR Officer</option>
                    </select>
                    <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
                </div>

                <!-- Department -->
                <div>
                    <label for="department_id" class="block text-sm font-medium text-white mb-2">Department</label>
                    <select id="department_id" name="department_id" required
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select your department</option>
                        @foreach(\App\Models\Department::all() as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                </div>

                <!-- Title -->
                <div>
                    <label for="title_id" class="block text-sm font-medium text-white mb-2">Title</label>
                    <select id="title_id" name="title_id" required
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select your title</option>
                        @foreach(\App\Models\Title::all() as $title)
                            <option value="{{ $title->id }}" {{ old('title_id') == $title->id ? 'selected' : '' }}>
                                {{ $title->title }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('title_id')" class="mt-2" />
                </div>

                <!-- Cohort -->
                <div>
                    <label for="cohort_id" class="block text-sm font-medium text-white mb-2">Cohort</label>
                    <select id="cohort_id" name="cohort_id" required
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select your cohort</option>
                        @foreach(\App\Models\Cohort::all() as $cohort)
                            <option value="{{ $cohort->id }}" {{ old('cohort_id') == $cohort->id ? 'selected' : '' }}>
                                {{ $cohort->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('cohort_id')" class="mt-2" />
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-white mb-2">Date of Birth</label>
                    <input id="date_of_birth" class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl" 
                           type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                </div>

                <!-- Bio -->
                <div>
                    <label for="bio" class="block text-sm font-medium text-white mb-2">Bio</label>
                    <textarea id="bio" name="bio" rows="3" 
                              class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl"
                              placeholder="Tell us about yourself...">{{ old('bio') }}</textarea>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
                    <input id="password" class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl"
                           type="password" name="password" required autocomplete="new-password"
                           placeholder="Create a strong password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Confirm Password</label>
                    <input id="password_confirmation" class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl"
                           type="password" name="password_confirmation" required autocomplete="new-password"
                           placeholder="Confirm your password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Terms -->
                <div class="flex items-center">
                    <input id="terms" type="checkbox" name="terms" required
                           class="rounded border-light-blue/20 text-accent focus:ring-accent bg-light-blue/10">
                    <label for="terms" class="ml-2 text-sm text-light-blue">
                        I agree to the 
                        <a href="#" class="text-accent hover:text-orange-corrected transition-colors duration-200">Terms of Service</a>
                        and 
                        <a href="#" class="text-accent hover:text-orange-corrected transition-colors duration-200">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                        Create Account
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-light-blue">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-accent hover:text-orange-corrected transition-colors duration-200 font-medium">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
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
