@extends('layouts.app')

@section('title', 'Versiones Estenográficas - Segob')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
        <!-- Filters Sidebar -->
        <x-posts.versions-filter :filters="$filters" />

        <!-- Content Area -->
        <div>
            <h1 class="text-3xl font-medium mb-8">Versiones Estenográficas</h1>
            <div class="space-y-6">
                @if($posts->isEmpty())
                    <div class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay versiones estenográficas disponibles
                    </div>
                @else
                    <div class="space-y-0">
                        @foreach($posts as $post)
                            <x-posts.post-article :post="$post" />
                        @endforeach
                    </div>

                    @if($posts->hasPages())
                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
