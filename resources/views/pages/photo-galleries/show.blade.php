@extends('layouts.app')

@section('title', $photoGallery->name . ' - Segob')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg border border-gray-100 shadow-lg py-6 px-12">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ $photoGallery->name }}
                </h1>
                <p class="text-gray-600 mb-6">
                    {{ \App\Helpers\DateHelper::formatSpanishDate($photoGallery->published_at) }}
                </p>

                <div class="swiper photo-slider">
                    <div class="swiper-wrapper">
                        @foreach($photoGallery->getMedia('photos') as $photo)
                        <div class="swiper-slide px-2">
                            <img
                                src="{{ $photo->getUrl() }}"
                                alt="{{ $photoGallery->name }}"
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
        </div>

        @if($photoGallery->posts->count() > 0)
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-100 shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Contenido relacionado</h2>
                <div class="mb-2">
                    <div class="divide-y divide-gray-200">
                        @foreach($photoGallery->posts as $post)
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.photo-slider', {
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
    });
</script>
@endpush
