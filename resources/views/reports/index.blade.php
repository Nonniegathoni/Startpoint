@extends('layouts.app')

@section('content')
@php
    $header = 'Reports';
@endphp
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h1 class="text-3xl font-bold text-white mb-2">Reports</h1>
        <p class="text-light-blue">
            Generate and view comprehensive reports about your internship program
        </p>
    </div>

    <!-- Reports Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Applications Report -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 rounded-xl bg-accent/20 shadow-glow-orange">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-white">Applications Report</h3>
                    <p class="text-sm text-light-blue">Track application statistics</p>
                </div>
            </div>
            <button class="w-full px-4 py-2 bg-gradient-to-r from-accent to-orange-corrected text-white font-medium rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                Generate Report
            </button>
        </div>

        <!-- Interns Report -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 rounded-xl bg-light-blue/20 shadow-glow">
                    <svg class="w-8 h-8 text-light-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-white">Interns Report</h3>
                    <p class="text-sm text-light-blue">Monitor intern performance</p>
                </div>
            </div>
            <button class="w-full px-4 py-2 bg-gradient-to-r from-accent to-orange-corrected text-white font-medium rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                Generate Report
            </button>
        </div>

        <!-- Department Report -->
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow hover:shadow-glow-strong transition-all duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 rounded-xl bg-medium-blue-purple/20 shadow-glow">
                    <svg class="w-8 h-8 text-medium-blue-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-white">Department Report</h3>
                    <p class="text-sm text-light-blue">Department-wise analysis</p>
                </div>
            </div>
            <button class="w-full px-4 py-2 bg-gradient-to-r from-accent to-orange-corrected text-white font-medium rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                Generate Report
            </button>
        </div>
    </div>
</div>
@endsection
