@extends('layouts.app')

@section('content')
@php
    $header = 'Notifications';
@endphp
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h1 class="text-3xl font-bold text-white mb-2">Notifications</h1>
        <p class="text-light-blue">
            Stay updated with your latest notifications and updates
        </p>
    </div>

    <!-- Notifications List -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        @if(auth()->user()->notifications()->count() > 0)
            <div class="space-y-4">
                @foreach(auth()->user()->notifications()->latest()->get() as $notification)
                    <div class="flex items-start p-4 rounded-xl bg-light-blue/10 hover:bg-light-blue/20 transition-colors duration-200">
                        <div class="flex-shrink-0 mr-4">
                            <div class="w-10 h-10 rounded-full bg-accent/20 flex items-center justify-center shadow-glow-orange">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white mb-1">{{ $notification->title }}</h3>
                            <p class="text-light-blue mb-2">{{ $notification->message }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-light-blue">{{ $notification->created_at->diffForHumans() }}</span>
                                @if($notification->isUnread())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent/20 text-accent">
                                        New
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-light-blue mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                </svg>
                <h3 class="text-lg font-medium text-white mb-2">No notifications yet</h3>
                <p class="text-light-blue">You're all caught up! New notifications will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
