@extends('layouts.app')

@section('content')
@php
    $header = 'Mark Notification as Read';
@endphp
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h1 class="text-3xl font-bold text-white mb-2">Mark Notification as Read</h1>
        <p class="text-light-blue">
            This page handles marking notifications as read
        </p>
    </div>

    <!-- Content -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-light-blue mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-white mb-2">Notification Updated</h3>
            <p class="text-light-blue mb-4">The notification has been marked as read.</p>
            <a href="{{ route('notifications.index') }}" class="inline-flex px-6 py-3 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 shadow-glow-orange">
                Back to Notifications
            </a>
        </div>
    </div>
</div>
@endsection
