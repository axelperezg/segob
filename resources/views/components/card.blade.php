@props([
    'padding' => true,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden' . ($padding ? ' p-6' : '')]) }}>
    {{ $slot }}
</div>
