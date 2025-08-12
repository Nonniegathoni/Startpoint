@extends('layouts.app')

@section('content')
@php
    $header = 'Add New Intern';
@endphp
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h1 class="text-3xl font-bold text-white mb-2">Add New Intern</h1>
        <p class="text-light-blue">
            Register a new intern to your program
        </p>
    </div>

    <!-- Intern Form -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <form method="POST" action="#" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- User Selection -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-white mb-2">Select User</label>
                    <select name="user_id" id="user_id" required
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Choose a user...</option>
                        @foreach(\App\Models\User::where('user_type', 'applicant')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }} ({{ $user->email_address }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Department -->
                <div>
                    <label for="department_id" class="block text-sm font-medium text-white mb-2">Department</label>
                    <select name="department_id" id="department_id" required
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select department...</option>
                        @foreach(\App\Models\Department::all() as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Supervisor -->
                <div>
                    <label for="supervisor_id" class="block text-sm font-medium text-white mb-2">Supervisor</label>
                    <select name="supervisor_id" id="supervisor_id" required
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">Select supervisor...</option>
                        @foreach(\App\Models\User::where('user_type', 'supervisor')->get() as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->first_name }} {{ $supervisor->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-white mb-2">Status</label>
                    <select name="status" id="status" required
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="terminated">Terminated</option>
                    </select>
                </div>

                <!-- Start Date -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-white mb-2">Start Date</label>
                    <input type="date" name="start_date" id="start_date" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                </div>

                <!-- End Date -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-white mb-2">End Date</label>
                    <input type="date" name="end_date" id="end_date"
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('interns.index') }}" 
                   class="px-6 py-3 bg-light-blue/10 text-white font-medium rounded-xl hover:bg-light-blue/20 transition-all duration-300 border border-light-blue/20">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                    Add Intern
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
