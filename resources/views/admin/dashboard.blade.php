@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Admin Dashboard</h1>
                <p class="text-light-blue">
                    Welcome back, {{ auth()->user()->first_name }}! Here's your system overview.
                </p>
            </div>
            <div class="hidden md:block">
                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center shadow-glow-orange">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-accent/20 shadow-glow-orange">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Total Users</p>
                    <p class="text-2xl font-bold text-white">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Active Opportunities -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-light-blue/20 shadow-glow">
                    <svg class="w-8 h-8 text-light-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Active Opportunities</p>
                    <p class="text-2xl font-bold text-white">{{ \App\Models\Opportunity::where('is_active', true)->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Reviews -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-orange-corrected/20 shadow-glow-orange">
                    <svg class="w-8 h-8 text-orange-corrected" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Pending Reviews</p>
                    <p class="text-2xl font-bold text-white">{{ \App\Models\Application::where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Active Interns -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-medium-blue-purple/20 shadow-glow">
                    <svg class="w-8 h-8 text-medium-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Active Interns</p>
                    <p class="text-2xl font-bold text-white">{{ \App\Models\Intern::where('status', 'active')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Applications -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Actions -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('opportunities.create') }}" class="flex items-center p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200 group">
                    <div class="p-2 rounded-lg bg-accent/20 group-hover:bg-accent/30 transition-all duration-200 shadow-glow-orange">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Post New Opportunity</p>
                        <p class="text-xs text-light-blue">Create a new internship position</p>
                    </div>
                </a>

                <a href="{{ route('applications.index') }}" class="flex items-center p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200 group">
                    <div class="p-2 rounded-lg bg-light-blue/20 group-hover:bg-light-blue/30 transition-all duration-200 shadow-glow">
                        <svg class="w-5 h-5 text-light-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Review Applications</p>
                        <p class="text-xs text-light-blue">Process pending applications</p>
                    </div>
                </a>

                <a href="{{ route('reports.index') }}" class="flex items-center p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200 group">
                    <div class="p-2 rounded-lg bg-medium-blue-purple/20 group-hover:bg-medium-blue-purple/30 transition-all duration-200 shadow-glow">
                        <svg class="w-5 h-5 text-medium-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Generate Reports</p>
                        <p class="text-xs text-light-blue">Create system reports</p>
                    </div>
                </a>

                <a href="{{ route('analytics.index') }}" class="flex items-center p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200 group">
                    <div class="p-2 rounded-lg bg-dark-blue-purple/20 group-hover:bg-dark-blue-purple/30 transition-all duration-200 shadow-glow">
                        <svg class="w-5 h-5 text-dark-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">View Analytics</p>
                        <p class="text-xs text-light-blue">System performance metrics</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <h3 class="text-lg font-semibold text-white mb-4">Recent Applications</h3>
            @if(\App\Models\Application::count() > 0)
                <div class="space-y-3">
                    @foreach(\App\Models\Application::with(['applicant', 'opportunity'])->latest()->take(5)->get() as $application)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center mr-3 shadow-glow-orange">
                                    <span class="text-white font-semibold text-sm">{{ substr($application->applicant->first_name, 0, 1) }}{{ substr($application->applicant->last_name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $application->applicant->first_name }} {{ $application->applicant->last_name }}</p>
                                    <p class="text-xs text-light-blue">{{ $application->opportunity->title }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <x-status-badge :status="$application->status" />
                                <span class="text-xs text-light-blue">{{ $application->created_at->diffForHumans() }}</span>
                            </div>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-light-blue mb-2">No applications yet</p>
                    <p class="text-sm text-light-blue">Applications will appear here once students start applying.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- System Overview -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h3 class="text-lg font-semibold text-white mb-6">System Overview</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- User Distribution -->
            <div class="space-y-3">
                <h4 class="text-md font-medium text-white">User Distribution</h4>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-light-blue">Applicants</span>
                        <span class="text-white font-medium">{{ \App\Models\User::where('user_type', 'applicant')->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-light-blue">Supervisors</span>
                        <span class="text-white font-medium">{{ \App\Models\User::where('user_type', 'supervisor')->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-light-blue">HR Officers</span>
                        <span class="text-white font-medium">{{ \App\Models\User::where('user_type', 'hr_officer')->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-light-blue">Admins</span>
                        <span class="text-white font-medium">{{ \App\Models\User::where('user_type', 'admin')->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Application Status -->
            <div class="space-y-3">
                <h4 class="text-md font-medium text-white">Application Status</h4>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-light-blue">Pending</span>
                        <span class="text-white font-medium">{{ \App\Models\Application::where('status', 'pending')->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-light-blue">Shortlisted</span>
                        <span class="text-white font-medium">{{ \App\Models\Application::where('status', 'shortlisted')->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-light-blue">Approved</span>
                        <span class="text-white font-medium">{{ \App\Models\Application::where('status', 'approved')->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-light-blue">Rejected</span>
                        <span class="text-white font-medium">{{ \App\Models\Application::where('status', 'rejected')->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Department Stats -->
            <div class="space-y-3">
                <h4 class="text-md font-medium text-white">Department Stats</h4>
                <div class="space-y-2">
                    @foreach(\App\Models\Department::withCount('opportunities')->take(4)->get() as $department)
                        <div class="flex justify-between text-sm">
                            <span class="text-light-blue">{{ $department->name }}</span>
                            <span class="text-white font-medium">{{ $department->opportunities_count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
