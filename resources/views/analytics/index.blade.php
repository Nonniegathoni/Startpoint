@extends('layouts.app')

@section('content')
@php
    $header = 'Analytics';
@endphp
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h1 class="text-3xl font-bold text-white mb-2">Analytics Dashboard</h1>
        <p class="text-light-blue">
            Comprehensive insights into your internship program performance
        </p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Applications -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-accent/20 shadow-glow-orange">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Total Applications</p>
                    <p class="text-2xl font-bold text-white">{{ \App\Models\Application::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Success Rate -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-light-blue/20 shadow-glow">
                    <svg class="w-8 h-8 text-light-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Success Rate</p>
                    <p class="text-2xl font-bold text-white">
                        @php
                            $total = \App\Models\Application::count();
                            $approved = \App\Models\Application::where('status', 'approved')->count();
                            echo $total > 0 ? round(($approved / $total) * 100, 1) : 0;
                        @endphp%
                    </p>
                </div>
            </div>
        </div>

        <!-- Active Interns -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
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

        <!-- Department Count -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-dark-blue-purple/20 shadow-glow">
                    <svg class="w-8 h-8 text-dark-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-light-blue">Departments</p>
                    <p class="text-2xl font-bold text-white">{{ \App\Models\Department::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Applications by Status -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <h3 class="text-lg font-semibold text-white mb-4">Applications by Status</h3>
            <div class="space-y-3">
                @php
                    $statuses = ['pending', 'shortlisted', 'approved', 'rejected'];
                    $colors = ['bg-yellow-500', 'bg-blue-500', 'bg-green-500', 'bg-red-500'];
                @endphp
                @foreach($statuses as $index => $status)
                    @php
                        $count = \App\Models\Application::where('status', $status)->count();
                        $total = \App\Models\Application::count();
                        $percentage = $total > 0 ? round(($count / $total) * 100, 1) : 0;
                    @endphp
                    <div class="flex items-center justify-between">
                        <span class="text-light-blue capitalize">{{ $status }}</span>
                        <div class="flex items-center space-x-3">
                            <div class="w-24 bg-light-blue/20 rounded-full h-2">
                                <div class="h-2 rounded-full {{ $colors[$index] }}" style="width: {{ $percentage }}%"></div>
                            </div>
                            <span class="text-white font-medium">{{ $count }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Monthly Trends -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <h3 class="text-lg font-semibold text-white mb-4">Monthly Trends</h3>
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-light-blue mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <p class="text-light-blue">Chart visualization coming soon</p>
            </div>
        </div>
    </div>
</div>
@endsection
