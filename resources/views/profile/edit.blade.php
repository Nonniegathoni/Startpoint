@extends('layouts.app')

@section('content')
@php
    $header = 'Edit Profile';
@endphp
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h1 class="text-3xl font-bold text-white mb-2">Edit Profile</h1>
        <p class="text-light-blue">
            Update your personal information and account settings
        </p>
    </div>

    <!-- Profile Information Form -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h2 class="text-xl font-semibold text-white mb-6">Profile Information</h2>
        
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-white mb-2">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl">
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-white mb-2">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl">
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email_address" class="block text-sm font-medium text-white mb-2">Email Address</label>
                    <input type="email" name="email_address" id="email_address" value="{{ old('email_address', auth()->user()->email_address) }}" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl">
                    @error('email_address')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-white mb-2">Phone Number</label>
                    <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}"
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl">
                    @error('phone_number')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-white mb-2">Title</label>
                    <select name="title" id="title" 
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select a title...</option>
                        @foreach(\App\Models\Title::all() as $title)
                            <option value="{{ $title->id }}" {{ old('title', auth()->user()->title_id) == $title->id ? 'selected' : '' }}>
                                {{ $title->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('title')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cohort -->
                <div>
                    <label for="cohort" class="block text-sm font-medium text-white mb-2">Cohort</label>
                    <select name="cohort" id="cohort" 
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select a cohort...</option>
                        @foreach(\App\Models\Cohort::all() as $cohort)
                            <option value="{{ $cohort->id }}" {{ old('cohort', auth()->user()->cohort_id) == $cohort->id ? 'selected' : '' }}>
                                {{ $cohort->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('cohort')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label for="department_id" class="block text-sm font-medium text-white mb-2">Department</label>
                    <select name="department_id" id="department_id" 
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select a department...</option>
                        @foreach(\App\Models\Department::all() as $department)
                            <option value="{{ $department->id }}" {{ old('department', auth()->user()->department_id) == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-white mb-2">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}"
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                    @error('date_of_birth')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Bio -->
            <div>
                <label for="bio" class="block text-sm font-medium text-white mb-2">Bio</label>
                <textarea name="bio" id="bio" rows="4" 
                          class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl"
                          placeholder="Tell us about yourself...">{{ old('bio', auth()->user()->bio) }}</textarea>
                @error('bio')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Account Information -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h2 class="text-xl font-semibold text-white mb-6">Account Information</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-light-blue mb-2">User ID</label>
                <input type="text" value="{{ auth()->user()->id }}" disabled
                       class="w-full bg-light-blue/10 border-light-blue/20 text-light-blue rounded-xl cursor-not-allowed">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-light-blue mb-2">User Type</label>
                <input type="text" value="{{ ucfirst(auth()->user()->user_type) }}" disabled
                       class="w-full bg-light-blue/10 border-light-blue/20 text-light-blue rounded-xl cursor-not-allowed">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-light-blue mb-2">Member Since</label>
                <input type="text" value="{{ auth()->user()->created_at->format('M d, Y') }}" disabled
                       class="w-full bg-light-blue/10 border-light-blue/20 text-light-blue rounded-xl cursor-not-allowed">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-light-blue mb-2">Email Verified</label>
                <input type="text" value="{{ auth()->user()->email_verified_at ? 'Yes' : 'No' }}" disabled
                       class="w-full bg-light-blue/10 border-light-blue/20 text-light-blue rounded-xl cursor-not-allowed">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-light-blue mb-2">Account Status</label>
                <input type="text" value="{{ auth()->user()->is_active ? 'Active' : 'Inactive' }}" disabled
                       class="w-full bg-light-blue/10 border-light-blue/20 text-light-blue rounded-xl cursor-not-allowed">
            </div>
        </div>
    </div>

    <!-- Update Password -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h2 class="text-xl font-semibold text-white mb-6">Update Password</h2>
        
        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-white mb-2">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-white mb-2">New Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl">
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl">
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-medium-blue-purple to-dark-blue-purple text-white font-semibold rounded-xl hover:from-medium-blue-purple/80 hover:to-dark-blue-purple/80 transition-all duration-300 shadow-glow">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h2 class="text-xl font-semibold text-white mb-6">Delete Account</h2>
        
        <p class="text-light-blue mb-6">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-6">
            @csrf
            @method('delete')

            <div>
                <label for="password_delete" class="block text-sm font-medium text-white mb-2">Password</label>
                <input type="password" name="password" id="password_delete" required
                       class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl"
                       placeholder="Enter your password to confirm">
                @error('password')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-all duration-300"
                        onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
