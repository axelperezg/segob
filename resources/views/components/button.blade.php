@props([
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $classes = match($variant) {
        'primary' => 'bg-red-600 hover:bg-red-700 text-white',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white',
        'outline' => 'border border-red-600 text-red-600 hover:bg-red-50',
        default => 'bg-red-600 hover:bg-red-700 text-white',
    };
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => "px-4 py-2 rounded-md font-medium transition-colors duration-200 {$classes}"]) }}
>
    {{ $slot }}
</button>
