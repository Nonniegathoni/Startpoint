@extends('layouts.app')

@section('content')
@php
    $header = 'Internship Opportunities';
@endphp
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Find Your Perfect Internship</h1>
                <p class="text-light-blue">
                    Discover exciting opportunities that match your skills and career goals
                </p>
            </div>
            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isHrOfficer()))
            <div class="mt-4 md:mt-0">
                <a href="{{ route('opportunities.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Post Opportunity
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <form method="GET" action="{{ route('opportunities.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-light-blue mb-2">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl" 
                           placeholder="Search opportunities...">
                </div>

                <!-- Department Filter -->
                <div>
                    <label for="department" class="block text-sm font-medium text-light-blue mb-2">Department</label>
                    <select name="department" id="department" 
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">All Departments</option>
                        @foreach(\App\Models\Department::all() as $department)
                            <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Opportunity Type Filter -->
                <div>
                    <label for="type" class="block text-sm font-medium text-light-blue mb-2">Type</label>
                    <select name="type" id="type" 
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">All Types</option>
                        @foreach(\App\Models\OpportunityType::all() as $type)
                            <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                {{ $type->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Compensation Type Filter -->
                <div>
                    <label for="compensation" class="block text-sm font-medium text-light-blue mb-2">Compensation</label>
                    <select name="compensation" id="compensation" 
                            class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                        <option value="">All Types</option>
                        @foreach(\App\Models\CompensationType::all() as $compType)
                            <option value="{{ $compType->id }}" {{ request('compensation') == $compType->id ? 'selected' : '' }}>
                                {{ $compType->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-accent to-orange-corrected text-white font-medium rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                    Apply Filters
                </button>
                <a href="{{ route('opportunities.index') }}" class="px-6 py-2 bg-light-blue/10 text-white font-medium rounded-xl hover:bg-light-blue/20 transition-all duration-300 text-center">
                    Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Opportunities Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($opportunities as $opportunity)
            <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 overflow-hidden hover:shadow-glow-strong transition-all duration-300 transform hover:scale-105 shadow-glow">
                <!-- Header -->
                <div class="p-6 border-b border-light-blue/20">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white mb-2 line-clamp-2">{{ $opportunity->title }}</h3>
                            <div class="flex items-center text-light-blue text-sm mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                {{ $opportunity->department->name }}
                            </div>
                        </div>
                        <div class="ml-3">
                            <x-status-badge :status="$opportunity->is_active ? 'active' : 'inactive'" />
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-light-blue text-sm line-clamp-3 mb-4">
                        {{ $opportunity->opportunity_description }}
                    </p>

                    <!-- Core Competencies -->
                    @if($opportunity->core_competencies)
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-white mb-2">Core Competencies:</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $opportunity->core_competencies) as $competency)
                                <span class="px-2 py-1 bg-accent/20 text-accent text-xs rounded-lg">
                                    {{ trim($competency) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Details -->
                <div class="p-6 space-y-3">
                    <!-- Compensation -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-light-blue">Compensation:</span>
                        <span class="text-sm font-medium text-white">{{ $opportunity->getFormattedAmountAttribute() }}</span>
                    </div>

                    <!-- Type -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-light-blue">Type:</span>
                        <span class="text-sm font-medium text-white">{{ $opportunity->opportunityType->type }}</span>
                    </div>

                    <!-- Expiry -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-light-blue">Expires:</span>
                        <span class="text-sm font-medium text-white {{ $opportunity->expiry_date->isPast() ? 'text-red-400' : 'text-green-400' }}">
                            {{ $opportunity->expiry_date->format('M d, Y') }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="pt-4 border-t border-light-blue/20">
                        @if(auth()->check() && auth()->user()->isApplicant())
                            @if($opportunity->applicants->contains(auth()->user()))
                                <div class="text-center">
                                    <span class="text-green-400 text-sm font-medium">✓ Already Applied</span>
                                </div>
                            @else
                                <a href="{{ route('applications.create', ['opportunity' => $opportunity->id]) }}" 
                                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-accent to-orange-corrected text-white font-medium rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                                    Apply Now
                                </a>
                            @endif
                        @endif

                        @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isHrOfficer()))
                            <div class="flex space-x-2">
                                <a href="{{ route('opportunities.show', $opportunity) }}" 
                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-light-blue/10 text-white font-medium rounded-xl hover:bg-light-blue/20 transition-all duration-300">
                                    View
                                </a>
                                <a href="{{ route('opportunities.edit', $opportunity) }}" 
                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-medium-blue-purple to-dark-blue-purple text-white font-medium rounded-xl hover:from-medium-blue-purple/80 hover:to-dark-blue-purple/80 transition-all duration-300 shadow-glow">
                                    Edit
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-light-blue mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-white mb-2">No opportunities found</h3>
                    <p class="text-light-blue mb-4">
                        Try adjusting your search criteria or check back later for new opportunities.
                    </p>
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isHrOfficer()))
                        <a href="{{ route('opportunities.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                            Post First Opportunity
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($opportunities->hasPages())
        <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
            <div class="flex items-center justify-between">
                <div class="text-sm text-light-blue">
                    Showing {{ $opportunities->firstItem() }} to {{ $opportunities->lastItem() }} of {{ $opportunities->total() }} results
                </div>
                <div class="flex space-x-2">
                    {{ $opportunities->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-clamp: 2; /* Added standard property */
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        line-clamp: 3; /* Added standard property */
        overflow: hidden;
    }
</style>
@endsection
