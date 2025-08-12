@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">
                    Welcome back, {{ auth()->user()->first_name }}! 👋
                </h1>
                <p class="text-light-blue">
                    Here's what's happening with your internship applications and assignments.
                </p>
            </div>
            <div class="hidden md:block">
                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center shadow-glow-orange">
                    <span class="text-white font-bold text-xl">{{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Applications -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-accent/20 shadow-glow-orange">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Total Applications</p>
                    <p class="text-2xl font-bold text-white">{{ auth()->user()->applications()->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Active Applications -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-light-blue/20 shadow-glow">
                    <svg class="w-8 h-8 text-light-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Active Applications</p>
                    <p class="text-2xl font-bold text-white">{{ auth()->user()->applications()->whereIn('status', ['pending', 'shortlisted'])->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Assignments -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-medium-blue-purple/20 shadow-glow">
                    <svg class="w-8 h-8 text-medium-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Current Assignments</p>
                    <p class="text-2xl font-bold text-white">{{ auth()->user()->assignments()->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Progress Reports -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-dark-blue-purple/20 shadow-glow">
                    <svg class="w-8 h-8 text-dark-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Progress Reports</p>
                    <p class="text-2xl font-bold text-white">{{ auth()->user()->progressReports()->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Applications -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <h3 class="text-lg font-semibold text-white mb-4">Recent Applications</h3>
            @if(auth()->user()->applications()->count() > 0)
                <div class="space-y-3">
                    @foreach(auth()->user()->applications()->latest()->take(5)->get() as $application)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center mr-3 shadow-glow-orange">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $application->opportunity->title }}</p>
                                    <p class="text-xs text-light-blue">{{ $application->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <x-status-badge :status="$application->status" />
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a href="{{ route('applications.index') }}" class="text-accent hover:text-orange-corrected text-sm font-medium transition-colors duration-200">
                        View all applications →
                    </a>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-light-blue mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                    </svg>
                    <p class="text-light-blue mb-2">No applications yet</p>
                    <a href="{{ route('opportunities.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-accent to-orange-corrected text-white text-sm font-medium rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                        Browse Opportunities
                    </a>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('opportunities.index') }}" class="flex items-center p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200 group">
                    <div class="p-2 rounded-lg bg-accent/20 group-hover:bg-accent/30 transition-all duration-200 shadow-glow-orange">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Browse Opportunities</p>
                        <p class="text-xs text-light-blue">Find your next internship</p>
                    </div>
                </a>

                <a href="{{ route('applications.create') }}" class="flex items-center p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200 group">
                    <div class="p-2 rounded-lg bg-light-blue/20 group-hover:bg-light-blue/30 transition-all duration-200 shadow-glow">
                        <svg class="w-5 h-5 text-light-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Submit Application</p>
                        <p class="text-xs text-light-blue">Apply for an opportunity</p>
                    </div>
                </a>

                <a href="{{ route('progress-reports.create') }}" class="flex items-center p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200 group">
                    <div class="p-2 rounded-lg bg-medium-blue-purple/20 group-hover:bg-medium-blue-purple/30 transition-all duration-200 shadow-glow">
                        <svg class="w-5 h-5 text-medium-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Submit Progress Report</p>
                        <p class="text-xs text-light-blue">Update your progress</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200 group">
                    <div class="p-2 rounded-lg bg-dark-blue-purple/20 group-hover:bg-dark-blue-purple/30 transition-all duration-200 shadow-glow">
                        <svg class="w-5 h-5 text-dark-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Update Profile</p>
                        <p class="text-xs text-light-blue">Manage your information</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isHrOfficer()))
    <!-- Admin/HR Dashboard Section -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h3 class="text-lg font-semibold text-white mb-4">Administrative Overview</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-4 rounded-xl bg-light-blue/10 shadow-glow">
                <div class="w-12 h-12 rounded-full bg-accent/20 flex items-center justify-center mx-auto mb-3 shadow-glow-orange">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-white">{{ \App\Models\User::where('user_type', 'applicant')->count() }}</p>
                <p class="text-sm text-light-blue">Total Applicants</p>
            </div>
            
            <div class="text-center p-4 rounded-xl bg-light-blue/10 shadow-glow">
                <div class="w-12 h-12 rounded-full bg-light-blue/20 flex items-center justify-center mx-auto mb-3 shadow-glow">
                    <svg class="w-6 h-6 text-light-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-white">{{ \App\Models\Opportunity::where('is_active', true)->count() }}</p>
                <p class="text-sm text-light-blue">Active Opportunities</p>
            </div>
            
            <div class="text-center p-4 rounded-xl bg-light-blue/10 shadow-glow">
                <div class="w-12 h-12 rounded-full bg-medium-blue-purple/20 flex items-center justify-center mx-auto mb-3 shadow-glow">
                    <svg class="w-6 h-6 text-medium-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-white">{{ \App\Models\Application::where('status', 'pending')->count() }}</p>
                <p class="text-sm text-light-blue">Pending Reviews</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
