@extends('layouts.app')

@section('title', $document->name . ' - Segob')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg border border-gray-100 shadow-lg py-6 px-12">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ $document->name }}
                </h1>
                <p class="text-gray-600 mb-6">
                    {{ \App\Helpers\DateHelper::formatSpanishDate($document->published_at) }}
                </p>

                @if(!$document->isInfographic)
                <div class="bg-gray-100 rounded-lg p-4 mb-6" style="min-height: 600px">
                    <iframe
                        src="{{ $document->document_file }}"
                        class="w-full h-full rounded-lg"
                        style="min-height: 600px"
                        frameborder="0"
                    ></iframe>
                </div>

                <div class="flex flex-col space-y-4 items-center justify-between mb-6">
                    <div class="flex gap-4">
                        <a
                            href="{{ $document->document_file }}"
                            download
                            target="_blank"
                            class="px-6 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 transition-colors"
                        >
                            Descargar PDF
                        </a>
                    </div>
                </div>
                @endif

                @if($document->getMedia('images')->count() > 0)
                <div class="{{ !$document->isInfographic ? 'pt-24' : '' }}">
                    <div class="swiper document-slider">
                        <div class="swiper-wrapper">
                            @foreach($document->getMedia('images') as $image)
                            <div class="swiper-slide px-2">
                                <img
                                    src="{{ $image->getUrl() }}"
                                    alt="{{ $document->name }}"
                                    class="w-full rounded-lg"
                                    style="max-height: 600px; object-fit: contain"
                                />
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-100 shadow p-6 mb-4">
                <div class="space-y-4">
                    @if(!$document->isInfographic)
                    <a
                        href="{{ $document->document_file }}"
                        download
                        target="_blank"
                        class="w-full px-6 py-3 bg-burgundy text-white rounded-md hover:bg-burgundy-soft transition-colors flex items-center justify-center gap-2"
                    >
                        <span>Descargar PDF</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
                            />
                        </svg>
                    </a>
                    @endif

                    @if($document->isInfographic || $document->getMedia('images')->count() > 0)
                    <button
                        x-data
                        @click="downloadGallery()"
                        class="w-full px-6 py-3 bg-burgundy text-white rounded-md hover:bg-burgundy-soft transition-colors flex items-center justify-center gap-2"
                    >
                        <span>Descargar Galería</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
                            />
                        </svg>
                    </button>
                    @endif
                </div>
            </div>

            @if($document->posts->count() > 0)
            <div class="bg-white rounded-lg border border-gray-100 shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Contenido relacionado</h2>
                <div class="mb-2">
                    <div class="divide-y divide-gray-200">
                        @foreach($document->posts as $post)
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
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jszip@3/dist/jszip.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        const swiper = new Swiper('.document-slider', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Download gallery function
        window.downloadGallery = async function() {
            const images = @json($document->getMedia('images')->map(fn($img) => $img->getUrl()));
            const documentName = @json($document->name);

            const zip = new JSZip();
            const imgFolder = zip.folder('images');

            for (let i = 0; i < images.length; i++) {
                try {
                    const response = await fetch(images[i]);
                    const blob = await response.blob();
                    imgFolder.file(`image-${i + 1}.jpg`, blob);
                } catch (error) {
                    console.error('Error downloading image:', error);
                }
            }

            const content = await zip.generateAsync({ type: 'blob' });
            const url = window.URL.createObjectURL(content);
            const link = document.createElement('a');
            link.href = url;
            link.download = `${documentName}-galeria.zip`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            window.URL.revokeObjectURL(url);
        };
    });
</script>
@endpush
