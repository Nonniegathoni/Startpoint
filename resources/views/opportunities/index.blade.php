@extends('layouts.app')

@section('title', 'Opportunities - StartPoint')
@section('page-title', 'Opportunities')
@section('page-description', 'Create, manage, and track opportunities for students and cohorts')

@section('header-actions')
    <a href="{{ route('opportunities.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i>
        Add Opportunity
    </a>
@endsection

@section('content')
    <!-- Search and Filters -->
    <div class="card mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('opportunities.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search opportunities..." 
                               class="form-input pl-10">
                    </div>
                </div>
                <div class="md:w-48">
                    <select name="department" class="form-input">
                        <option value="">All Departments</option>
                        @if(isset($departments))
                            @foreach($departments as $department)
                                <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                                    {{ $department }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn-secondary">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="card">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Opportunities</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-briefcase text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active</p>
                        <p class="text-3xl font-bold text-green-600">{{ $stats['active'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Expiring Soon</p>
                        <p class="text-3xl font-bold text-orange-600">{{ $stats['expiring'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Expired</p>
                        <p class="text-3xl font-bold text-red-600">{{ $stats['expired'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Opportunities List -->
    <div class="card">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">All Opportunities</h2>
                    <p class="text-gray-600">Manage and track all available opportunities</p>
                </div>
                @if(isset($opportunities))
                    <div class="text-sm text-gray-500">
                        Showing {{ $opportunities->count() }} of {{ $opportunities->total() }} opportunities
                    </div>
                @endif
            </div>
        </div>
        
        <div class="divide-y divide-gray-200">
            @if(isset($opportunities) && $opportunities->count() > 0)
                @foreach($opportunities as $opportunity)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $opportunity->title }}</h3>
                                    @php
                                        $status = $opportunity->status ?? 'Active';
                                        $statusClass = match($status) {
                                            'Active' => 'status-active',
                                            'Expiring Soon' => 'status-expiring',
                                            'Expired' => 'status-expired',
                                            default => 'status-inactive'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $status }}
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-building text-gray-400"></i>
                                        <span>{{ $opportunity->department }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-briefcase text-gray-400"></i>
                                        <span>{{ $opportunity->opportunity_type }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-money-bill-wave text-gray-400"></i>
                                        <span>{{ $opportunity->compensation_type }}</span>
                                        @if(isset($opportunity->compensation_amount) && $opportunity->compensation_amount > 0)
                                            <span class="font-semibold text-green-600">
                                                - KES {{ number_format($opportunity->compensation_amount, 0, '.', ',') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-calendar text-gray-400"></i>
                                        <span>Expires: {{ \Carbon\Carbon::parse($opportunity->expiry_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-2 ml-4">
                                <a href="{{ route('opportunities.show', $opportunity) }}" 
                                   class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-eye mr-1"></i>
                                    View
                                </a>
                                <a href="{{ route('opportunities.edit', $opportunity) }}" 
                                   class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-briefcase text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No opportunities found</h3>
                    <p class="text-gray-600 mb-6">Get started by creating your first opportunity.</p>
                    <a href="{{ route('opportunities.create') }}" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Create Opportunity
                    </a>
                </div>
            @endif
        </div>
        
        @if(isset($opportunities) && $opportunities->hasPages())
            <div class="p-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing {{ $opportunities->firstItem() }} to {{ $opportunities->lastItem() }} of {{ $opportunities->total() }} results
                    </div>
                    <div class="flex items-center gap-2">
                        @if($opportunities->onFirstPage())
                            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded-lg">Previous</span>
                        @else
                            <a href="{{ $opportunities->previousPageUrl() }}" 
                               class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                Previous
                            </a>
                        @endif
                        
                        @if($opportunities->hasMorePages())
                            <a href="{{ $opportunities->nextPageUrl() }}" 
                               class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                Next
                            </a>
                        @else
                            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded-lg">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
