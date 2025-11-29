@extends('layouts.app')

@section('title', 'Galerías de fotos - Segob')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
        <!-- Filters Sidebar -->
        <x-photo-galleries.galleries-filter :filters="$filters" />

        <!-- Content Area -->
        <div>
            <h1 class="text-3xl font-medium mb-8">Galerías de fotos</h1>
            <div class="space-y-6">
                @if($galleries->isEmpty())
                    <div class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay galerías de fotos disponibles
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3">
                        @foreach($galleries as $gallery)
                            <x-photo-galleries.gallery-article :gallery="$gallery" />
                        @endforeach
                    </div>

                    @if($galleries->hasPages())
                        <div class="mt-6">
                            {{ $galleries->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
