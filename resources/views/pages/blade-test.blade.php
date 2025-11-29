@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="mb-8 text-4xl font-bold text-gray-800">{{ $testData['message'] }}</h1>

    {{-- Test Card Component --}}
    <x-card class="mb-8">
        <h2 class="mb-4 text-2xl font-bold">Card Component Test</h2>
        <p class="text-gray-600">This is a test card component with Tailwind CSS styling.</p>
    </x-card>

    {{-- Test Button Components --}}
    <div class="mb-8">
        <h2 class="mb-4 text-2xl font-bold">Button Component Test</h2>
        <div class="flex gap-4">
            <x-button variant="primary">Primary Button</x-button>
            <x-button variant="secondary">Secondary Button</x-button>
            <x-button variant="outline">Outline Button</x-button>
        </div>
    </div>

    {{-- Test Link Component --}}
    <div class="mb-8">
        <h2 class="mb-4 text-2xl font-bold">Link Component Test</h2>
        <div class="flex gap-4">
            <x-link href="#" variant="primary">Primary Link</x-link>
            <x-link href="#" variant="secondary">Secondary Link</x-link>
            <x-link href="#" variant="nav">Nav Link</x-link>
        </div>
    </div>

    {{-- Test Badge Component --}}
    <div class="mb-8">
        <h2 class="mb-4 text-2xl font-bold">Badge Component Test</h2>
        <div class="flex gap-2">
            <x-badge variant="primary">Primary</x-badge>
            <x-badge variant="secondary">Secondary</x-badge>
            <x-badge variant="success">Success</x-badge>
            <x-badge variant="warning">Warning</x-badge>
            <x-badge variant="info">Info</x-badge>
        </div>
    </div>

    {{-- Test Alpine.js --}}
    <x-card class="mb-8">
        <h2 class="mb-4 text-2xl font-bold">Alpine.js Test</h2>
        <div x-data="{ count: 0 }">
            <p class="mb-4">Counter: <span x-text="count" class="font-bold text-red-600"></span></p>
            <div class="flex gap-2">
                <button @click="count++" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                    Increment
                </button>
                <button @click="count--" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                    Decrement
                </button>
            </div>
        </div>
    </x-card>

    {{-- Test Shared Data --}}
    <x-card class="mb-8">
        <h2 class="mb-4 text-2xl font-bold">Shared Data Test</h2>
        <p class="mb-2 text-gray-600"><strong>Main Menu Items:</strong> {{ count($mainMenu) }}</p>
        <p class="mb-2 text-gray-600"><strong>App Name:</strong> {{ $appSettings['meta_title'] ?? 'N/A' }}</p>
        <p class="text-gray-600"><strong>Meta Description:</strong> {{ $appSettings['meta_description'] ?? 'N/A' }}</p>
    </x-card>

    {{-- Test Loop --}}
    <x-card>
        <h2 class="mb-4 text-2xl font-bold">Loop Test</h2>
        <ul class="space-y-2">
            @foreach($testData['items'] as $item)
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                    <span>{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    </x-card>
</div>
@endsection
