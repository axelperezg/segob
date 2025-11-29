@extends('layouts.app')

@section('title', $video->title . ' - Segob')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg border border-gray-100 shadow-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ $video->title }}
                </h1>
                <p class="text-gray-600 mb-6">
                    {{ \App\Helpers\DateHelper::formatSpanishDate($video->published_at) }}
                </p>

                <div class="video-container aspect-video mb-6">
                    <iframe
                        src="{{ str_replace('watch?v=', 'embed/', $video->url) }}"
                        class="w-full h-full rounded-lg"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>

        @if($video->posts->count() > 0)
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-100 shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Contenido relacionado</h2>
                <div class="mb-2">
                    <div class="divide-y divide-gray-200">
                        @foreach($video->posts as $post)
                        <div class="py-3">
                            <a
                                href="{{ route('posts.show', $post->slug) }}"
                                class="block hover:bg-gray-50 rounded-lg transition-colors"
                            >
                                <h3 class="font-semibold text-gray-700">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ \App\Helpers\DateHelper::formatSpanishDate($post->published_at) }}
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
