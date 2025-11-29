@extends('layouts.app')

@section('title', $appSettings['meta_title'])
@section('meta_description', $appSettings['meta_description'])

@section('content')
    {{-- Featured Posts Section --}}
    <section class="py-8 mx-auto max-w-7xl">
        <a href="{{ route('news.index') }}" 
           class="text-2xl font-bold lg:text-3xl hover:text-gold transition-colors hover:underline hover:cursor-pointer">
            Noticias
        </a>

        @if(!$mainPosts->count() && !$secondaryPosts->count() && !$tertiaryPosts->count())
            <div class="py-12 text-center">
                <p class="text-xl text-gray-600">No hay noticias disponibles en este momento.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 pt-4 pb-8 md:flex">
                {{-- Main posts (left side) --}}
                <div class="space-y-6 md:w-8/12 lg:w-2/3">
                    @foreach($mainPosts as $post)
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <article class="overflow-hidden border rounded-lg">
                                <img src="{{ $post->getFirstMediaUrl('image') }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full" />
                                <div class="p-4">
                                    <h2 class="mb-2 text-xl font-bold md:text-4xl">{{ $post->title }}</h2>
                                    <p class="mb-1 text-xs italic text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="inline-block w-3 h-3 mr-1"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ App\Helpers\DateHelper::formatSpanishDate($post->published_at) }}
                                    </p>
                                    <div class="max-w-6xl prose">
                                        {!! $post->excerpt !!}
                                    </div>
                                </div>
                            </article>
                        </a>
                    @endforeach
                </div>

                {{-- Secondary posts (right side) --}}
                <div class="space-y-6 md:w-4/12 lg:w-1/3">
                    @foreach($secondaryPosts as $post)
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <article class="overflow-hidden border rounded-lg">
                                <img src="{{ $post->getFirstMediaUrl('image') }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full" />
                                <div class="p-4">
                                    <h2 class="mb-2 text-lg font-bold leading-tight">{{ $post->title }}</h2>
                                    <p class="mb-1 text-xs italic text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="inline-block w-3 h-3 mr-1"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ App\Helpers\DateHelper::formatSpanishDate($post->published_at) }}
                                    </p>
                                </div>
                            </article>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Tertiary posts (bottom grid) --}}
            <div class="space-y-6 md:grid md:grid-cols-2 md:gap-6 md:space-y-0 lg:grid-cols-3">
                @foreach($tertiaryPosts as $post)
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <article class="overflow-hidden border rounded-lg">
                            <img src="{{ $post->getFirstMediaUrl('image') }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full" />
                            <div class="p-4">
                                <h2 class="mb-2 text-lg font-bold">{{ $post->title }}</h2>
                                <p class="mb-1 text-xs italic text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="inline-block w-3 h-3 mr-1"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ App\Helpers\DateHelper::formatSpanishDate($post->published_at) }}
                                </p>
                            </div>
                        </article>
                    </a>
                @endforeach
            </div>

            <div class="flex justify-center mt-8">
                <a href="{{ route('news.index') }}" 
                   class="px-8 py-2 font-medium text-white transition-colors rounded bg-burgundy hover:bg-gold">
                    Ver más
                </a>
            </div>
        @endif
    </section>

    {{-- Actions Section --}}
    <x-home.actions :actions="$actions" />

    {{-- Banners Section --}}
    <x-home.banners :banners="$banners" />

    {{-- Dependencies Section --}}
    <x-home.dependencies :dependencies="$dependencies" />

    {{-- Noticias MX Section --}}
    <x-home.noticias-mx />

    {{-- Infographics Section --}}
    <x-home.infographics :infographics="$infographics" />

    {{-- Media Gallery Section (Photos + Videos) --}}
    <x-home.media-gallery :photos="$photos" :videos="$videos" />

    {{-- Contact Section --}}
    <x-home.contact />
@endsection

