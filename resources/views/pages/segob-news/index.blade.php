@extends('layouts.app')

@section('title', 'Noticias Segob - Segob')

@section('content')
    <!-- Banner Section -->
    <div class="flex justify-center bg-[#F1EDE1] -mx-4 -mt-8 py-6 mb-8">
        @if($dependency)
            <img src="{{ $dependency->image }}" alt="Banner" class="w-[20rem]" />
        @endif
    </div>

    <!-- Posts Layout with Filters -->
    <x-posts.posts-layout
        :posts="$posts"
        title="Noticias Segob"
        :filters="$filters"
        :show-dependency="false"
    />

    <!-- Bottom Section -->
    <div class="mx-auto max-w-7xl">
        <div class="pt-10 my-6">
            <!-- Quick Links -->
            <div class="flex flex-col justify-center gap-16 my-8 md:flex-row lg:gap-32">
                <!-- Versiones Link -->
                <div class="flex flex-col items-center">
                    <div class="p-4 mb-2 border rounded-lg">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z"
                            />
                        </svg>
                    </div>
                    <a
                        href="{{ route('versions.index') }}"
                        class="px-8 py-2 text-lg border rounded text-burgundy border-burgundy"
                    >
                        Versiones
                    </a>
                </div>

                <!-- Galerías Link -->
                <div class="flex flex-col items-center">
                    <div class="p-4 mb-2 border rounded-lg">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                    </div>
                    <a
                        href="{{ route('photo-galleries.index') }}"
                        class="px-8 py-2 text-lg border rounded text-burgundy border-burgundy"
                    >
                        Galerías
                    </a>
                </div>

                <!-- Videos Link -->
                <div class="flex flex-col items-center">
                    <div class="p-4 mb-2 border rounded-lg">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"
                            />
                        </svg>
                    </div>
                    <a
                        href="{{ route('videos.index') }}"
                        class="px-8 py-2 text-lg border rounded text-burgundy border-burgundy"
                    >
                        Videos
                    </a>
                </div>
            </div>

            <!-- Dependencies Carousel -->
            <x-dependencies.dependencies-carousel :dependencies="$dependencies" />
        </div>
    </div>
@endsection
