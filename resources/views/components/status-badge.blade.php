@props(['status'])

@php
    $statusClasses = [
        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
        'shortlisted' => 'bg-blue-100 text-blue-800 border-blue-200',
        'approved' => 'bg-green-100 text-green-800 border-green-200',
        'rejected' => 'bg-red-100 text-red-800 border-red-200',
        'active' => 'bg-green-100 text-green-800 border-green-200',
        'inactive' => 'bg-gray-100 text-gray-800 border-gray-200',
        'completed' => 'bg-purple-100 text-purple-800 border-purple-200',
        'cancelled' => 'bg-red-100 text-red-800 border-red-200',
        'draft' => 'bg-gray-100 text-gray-800 border-gray-200',
        'published' => 'bg-green-100 text-green-800 border-green-200',
    ];
    
    $statusText = [
        'pending' => 'Pending',
        'shortlisted' => 'Shortlisted',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'draft' => 'Draft',
        'published' => 'Published',
    ];
    
    $defaultClasses = 'bg-gray-100 text-gray-800 border-gray-200';
    $classes = $statusClasses[$status] ?? $defaultClasses;
    $text = $statusText[$status] ?? ucfirst($status);
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $classes }}">
    {{ $text }}
</span> 