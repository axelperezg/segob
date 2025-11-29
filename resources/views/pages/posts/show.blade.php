@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ activeTab: 1 }">
    <h1 class="text-4xl font-medium">{{ $post->title }}</h1>
    <div class="pt-3">
        <p class="text-sm text-burgundy-soft flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    class="fill-gray-700"
                    d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l352 0 0 256c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256z"
                />
            </svg>
            {{ \App\Helpers\DateHelper::formatSpanishDate($post->published_at) }}
        </p>
    </div>

    <section class="py-8 flex justify-center">
        <img class="w-full" src="{{ $post->getFirstMediaUrl('image') }}" alt="Featured Image" />
    </section>

    <div class="pb-4">
        <div class="border-b border-gray-200">
            <nav class="flex flex-col md:flex-row gap-6">
                <button
                    @click="activeTab = 1"
                    :class="[
                        'py-2 font-[400] text-lg border-b-4 transition-colors',
                        activeTab === 1 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                    ]"
                >
                    {{ $post->content_type->getLabel() }}
                </button>

                @if($post->photo_gallery_id)
                <button
                    @click="activeTab = 2"
                    :class="[
                        'py-2 font-[400] text-lg border-b-4 transition-colors',
                        activeTab === 2 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                    ]"
                >
                    Fotografías
                </button>
                @endif

                @if($post->audio_id)
                <button
                    @click="activeTab = 3"
                    :class="[
                        'py-2 font-[400] text-lg border-b-4 transition-colors',
                        activeTab === 3 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                    ]"
                >
                    Audio
                </button>
                @endif

                @if($post->document_id)
                <button
                    @click="activeTab = 4"
                    :class="[
                        'py-2 font-[400] text-lg border-b-4 transition-colors',
                        activeTab === 4 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                    ]"
                >
                    Documento
                </button>
                @endif

                @if($post->video_id)
                <button
                    @click="activeTab = 5"
                    :class="[
                        'py-2 font-[400] text-lg border-b-4 transition-colors',
                        activeTab === 5 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                    ]"
                >
                    Video
                </button>
                @endif

                @if($post->stenographic_version_id)
                <button
                    @click="activeTab = 6"
                    :class="[
                        'py-2 font-[400] text-lg border-b-4 transition-colors',
                        activeTab === 6 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                    ]"
                >
                    Versión Estenográfica
                </button>
                @endif
            </nav>
        </div>

        <div class="mt-4">
            {{-- Tab 1: Contenido principal --}}
            <div x-show="activeTab === 1">
                <div class="prose-lg max-w-7xl">
                    {!! $post->content !!}
                </div>
                <div class="flex justify-center">
                    <div class="flex flex-wrap gap-2 items-center border-l border-gray-400 pl-2 mt-10">
                        {{ $post->dependencies->pluck('name')->join(', ') }}
                    </div>
                </div>
            </div>

            @if($post->content_type->value === 'press_release')
            <div class="pt-10">
                <p class="text-lg font-bold">Comunicado No. {{ $post->bulletin }}</p>
            </div>
            @endif

            {{-- Tab 2: Galería de fotos --}}
            @if($post->photoGallery)
            <div class="grid grid-cols-3 gap-4" x-show="activeTab === 2" x-cloak>
                @foreach($post->photoGallery->getMedia('photos') as $photo)
                <a href="{{ $photo->getUrl() }}" download>
                    <img class="rounded-md" src="{{ $photo->getUrl() }}" alt="{{ $post->title }}" />
                </a>
                @endforeach
            </div>
            @endif

            {{-- Tab 3: Audio --}}
            @if($post->audio)
            <div class="max-w-3xl mx-auto" x-show="activeTab === 3" x-cloak>
                <div class="flex flex-col items-center">
                    <audio controls class="w-full">
                        <source src="{{ $post->audio->getFirstMediaUrl('audio') }}" type="audio/mpeg" />
                        Tu navegador no soporta el elemento de audio.
                    </audio>
                    <div class="flex justify-center mb-4 mt-10">
                        <a
                            href="{{ $post->audio->getFirstMediaUrl('audio') }}"
                            download
                            class="bg-gold hover:bg-gold/90 text-lg text-white font-medium py-2 px-4 rounded inline-flex items-center"
                        >
                            <span>Descargar Audio</span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- Tab 4: Documento --}}
            @if($post->document)
            <div class="w-full h-screen" x-show="activeTab === 4" x-cloak>
                <iframe src="{{ $post->document->getFirstMediaUrl('document') }}" class="w-full h-[80vh]" type="application/pdf"></iframe>
                <div class="flex justify-center mb-4 mt-10">
                    <a
                        href="{{ $post->document->getFirstMediaUrl('document') }}"
                        download
                        class="bg-gold hover:bg-gold/90 text-lg text-white font-medium py-2 px-4 rounded inline-flex items-center"
                    >
                        <span>Descargar PDF</span>
                    </a>
                </div>
            </div>
            @endif

            {{-- Tab 5: Video --}}
            @if($post->video)
            <div class="max-w-5xl mx-auto h-screen" x-show="activeTab === 5" x-cloak>
                <div class="flex flex-col items-center">
                    <div class="relative w-full pt-[56.25%]">
                        @php
                            parse_str(parse_url($post->video->url, PHP_URL_QUERY), $queryParams);
                            $videoId = $queryParams['v'] ?? '';
                        @endphp
                        <iframe
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            class="absolute top-0 left-0 w-full h-full"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
            </div>
            @endif

            {{-- Tab 6: Versión Estenográfica --}}
            @if($post->stenographicVersion)
            <div class="max-w-5xl mx-auto" x-show="activeTab === 6" x-cloak>
                <div class="prose-lg">
                    {!! $post->stenographicVersion->content !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
