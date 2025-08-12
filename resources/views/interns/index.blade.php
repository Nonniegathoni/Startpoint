@extends('layouts.app')

@section('content')
@php
    $header = 'Interns Management';
@endphp
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Interns Management</h1>
                <p class="text-light-blue">
                    Manage and monitor all interns in your program
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('interns.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New Intern
                </a>
            </div>
        </div>
    </div>

    <!-- Interns List -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-light-blue/20">
                        <th class="text-left py-3 px-4 text-white font-semibold">Name</th>
                        <th class="text-left py-3 px-4 text-white font-semibold">Department</th>
                        <th class="text-left py-3 px-4 text-white font-semibold">Supervisor</th>
                        <th class="text-left py-3 px-4 text-white font-semibold">Status</th>
                        <th class="text-left py-3 px-4 text-white font-semibold">Start Date</th>
                        <th class="text-left py-3 px-4 text-white font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Intern::with(['user', 'department', 'supervisor'])->get() as $intern)
                        <tr class="border-b border-light-blue/10 hover:bg-light-blue/5 transition-colors duration-200">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-accent to-orange-corrected flex items-center justify-center mr-3 shadow-glow-orange">
                                        <span class="text-white font-semibold text-sm">{{ substr($intern->user->first_name, 0, 1) }}{{ substr($intern->user->last_name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ $intern->user->first_name }} {{ $intern->user->last_name }}</p>
                                        <p class="text-sm text-light-blue">{{ $intern->user->email_address }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-light-blue">{{ $intern->department->name ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-light-blue">{{ $intern->supervisor->first_name ?? 'N/A' }} {{ $intern->supervisor->last_name ?? '' }}</td>
                            <td class="py-3 px-4">
                                <x-status-badge :status="$intern->status" />
                            </td>
                            <td class="py-3 px-4 text-light-blue">{{ $intern->start_date ? $intern->start_date->format('M d, Y') : 'N/A' }}</td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-accent hover:text-orange-corrected transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-light-blue hover:text-accent transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <svg class="w-16 h-16 text-light-blue mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-white mb-2">No interns yet</h3>
                                <p class="text-light-blue mb-4">Start by adding your first intern to the program.</p>
                                <a href="{{ route('interns.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                                    Add First Intern
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
