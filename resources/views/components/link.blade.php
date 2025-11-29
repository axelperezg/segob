@props([
    'href' => '#',
    'variant' => 'default',
])

@php
    $classes = match($variant) {
        'primary' => 'text-red-600 hover:text-red-700 font-medium',
        'secondary' => 'text-gray-600 hover:text-gray-700',
        'nav' => 'text-white hover:text-red-200',
        default => 'text-blue-600 hover:text-blue-700 hover:underline',
    };
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "transition-colors duration-200 {$classes}"]) }}
>
    {{ $slot }}
</a>
