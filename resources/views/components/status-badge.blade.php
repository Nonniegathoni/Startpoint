@props(['status'])

@php
    $statusClasses = [
        'approved' => 'bg-green-100 text-green-800',
        'rejected' => 'bg-red-100 text-red-800',
        'shortlisted' => 'bg-yellow-100 text-yellow-800',
        'withdrawn' => 'bg-gray-100 text-gray-800',
        'pending' => 'bg-blue-100 text-blue-800',
        'active' => 'bg-green-100 text-green-800',
        'completed' => 'bg-blue-100 text-blue-800',
        'terminated' => 'bg-red-100 text-red-800',
        'cancelled' => 'bg-gray-100 text-gray-800'
    ];
    $statusClass = $statusClasses[$status] ?? 'bg-blue-100 text-blue-800';
@endphp

<span {{ $attributes->merge(['class' => 'px-2 py-1 text-xs font-semibold rounded-full ' . $statusClass]) }}>
    {{ ucfirst($status) }}
</span> 