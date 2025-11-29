@extends('layouts.app')

@section('title', 'Videos - Segob')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
        <!-- Filters Sidebar -->
        <x-videos.videos-filter :filters="$filters" />

        <!-- Content Area -->
        <div>
            <h1 class="text-3xl font-medium mb-8">Videos</h1>
            <div class="space-y-6">
                @if($videos->isEmpty())
                    <div class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay videos disponibles
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($videos as $video)
                            <x-videos.video-article :video="$video" />
                        @endforeach
                    </div>

                    @if($videos->hasPages())
                        <div class="mt-6">
                            {{ $videos->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
