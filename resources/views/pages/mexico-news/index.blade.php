@extends('layouts.app')

@section('title', 'Noticias México - Segob')

@section('content')
<div class="px-4 py-8 mx-auto max-w-7xl" x-data="{
    selectedDate: '{{ $filters['published_at'] ?? '' }}',
    isPdfModalOpen: false,
    currentPdf: {
        url: '',
        pageUrl: '',
        title: ''
    },
    openPdfModal(url, pageUrl, title) {
        this.currentPdf = { url, pageUrl, title };
        this.isPdfModalOpen = true;
    },
    closePdfModal() {
        this.isPdfModalOpen = false;
    },
    formatTime(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes}`;
    },
    clearDateFilter() {
        window.location.href = '{{ route('mexico-news.index') }}';
    }
}">
    <h1 class="mb-6 text-3xl font-bold text-gray-800">Noticias México</h1>

    {{-- Date Filter --}}
    <div class="mb-8">
        <form method="GET" class="flex flex-col items-center gap-4 sm:flex-row sm:items-stretch">
            <label for="date-filter" class="font-medium text-gray-700">Filtrar por fecha:</label>
            <div class="flex w-full sm:w-auto">
                <input
                    type="date"
                    id="date-filter"
                    name="published_at"
                    x-model="selectedDate"
                    @change="$el.form.submit()"
                    class="px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                    style="min-width: 200px;"
                />
                <button
                    type="button"
                    x-show="selectedDate"
                    @click="clearDateFilter()"
                    class="px-3 py-2 text-white bg-red-700 rounded-r-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    title="Limpiar filtro"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <div class="flex flex-col md:flex-row md:gap-6">
        {{-- Main Content (2/3 width) --}}
        <div class="w-full md:w-2/3">
            {{-- Featured Post --}}
            <div class="mb-6">
                @if($mainPosts->isNotEmpty())
                @php $featuredPost = $mainPosts[0]; @endphp
                <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                    <a href="{{ $featuredPost->url }}" target="_blank" class="block cursor-pointer">
                        <div class="relative">
                            <img
                                src="{{ $featuredPost->getFirstMediaUrl('featured_image') }}"
                                alt="Noticia destacada"
                                class="object-cover w-full h-80"
                            />
                            <div class="absolute bottom-0 left-0 flex items-center p-2 bg-white">
                                <span class="text-sm text-gray-600" x-text="formatTime('{{ $featuredPost->published_at }}')"></span>
                            </div>
                            <div class="absolute top-0 right-0 px-2 py-1 text-xs text-white bg-red-700">
                                {{ $featuredPost->mexicoDependency->name }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="mb-3 text-xl font-semibold text-gray-800">{{ $featuredPost->title }}</h2>
                        </div>
                    </a>
                    @if($featuredPost->pdf)
                    <div class="px-4 pb-4">
                        <div class="flex items-center text-gray-600 hover:text-red-700 cursor-pointer">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"
                                />
                            </svg>
                            <a href="#" @click.prevent="openPdfModal('{{ $featuredPost->pdf }}', '{{ $featuredPost->url }}', '{{ $featuredPost->title }}')" class="text-sm">
                                Descargar PDF
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                @else
                <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                    <div class="p-4">
                        <h2 class="mb-3 text-xl font-semibold text-gray-800">
                            No hay noticias disponibles para la fecha seleccionada.
                        </h2>
                    </div>
                </div>
                @endif
            </div>

            {{-- Secondary Posts (2nd and 3rd) --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach($mainPosts->slice(1, 2) as $post)
                <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                    <a href="{{ $post->url }}" target="_blank" class="block cursor-pointer">
                        <div class="relative">
                            <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="{{ $post->title }}" class="object-cover w-full h-48" />
                            <div class="absolute bottom-0 left-0 flex items-center p-2 bg-white">
                                <span class="text-sm text-gray-600" x-text="formatTime('{{ $post->published_at }}')"></span>
                            </div>
                            <div class="absolute top-0 right-0 px-2 py-1 text-xs text-white bg-red-700">
                                {{ $post->mexicoDependency->name }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="mb-3 text-lg font-semibold text-gray-800">{{ $post->title }}</h2>
                        </div>
                    </a>
                    @if($post->pdf)
                    <div class="px-4 pb-4">
                        <div class="flex items-center text-gray-600 hover:text-red-700 cursor-pointer">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"
                                />
                            </svg>
                            <a href="#" @click.prevent="openPdfModal('{{ $post->pdf }}', '{{ $post->url }}', '{{ $post->title }}')" class="text-sm">
                                Descargar PDF
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        {{-- Sidebar (1/3 width) - Tertiary Posts --}}
        <div class="w-full mt-6 md:mt-0 md:w-1/3">
            <div class="flex flex-col space-y-4">
                @foreach($posts as $post)
                <a
                    href="{{ $post->url }}"
                    target="_blank"
                    class="p-4 transition-colors border border-gray-200 rounded-md shadow-sm hover:bg-gray-50"
                >
                    <div class="flex items-center mb-2 space-x-1">
                        <div class="flex items-center text-gray-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            <span class="text-sm" x-text="formatTime('{{ $post->published_at }}')"></span>
                        </div>
                        <div class="text-sm font-medium text-red-700">{{ $post->mexicoDependency->name }}</div>
                    </div>
                    <h2 class="mb-3 text-lg font-semibold text-gray-800">{{ $post->title }}</h2>
                    @if($post->pdf)
                    <div class="flex items-center text-gray-600 hover:text-red-700 cursor-pointer">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"
                            />
                        </svg>
                        <a href="#" @click.stop.prevent="openPdfModal('{{ $post->pdf }}', '{{ $post->url }}', '{{ $post->title }}')" class="text-sm">
                            Descargar PDF
                        </a>
                    </div>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    @if($posts->hasPages())
    <div class="mt-10">
        {{ $posts->appends(request()->query())->links() }}
    </div>
    @endif

    {{-- PDF Viewer Modal --}}
    <div
        x-show="isPdfModalOpen"
        x-cloak
        @keydown.escape.window="closePdfModal()"
        class="fixed inset-0 z-50 overflow-y-auto"
        role="dialog"
        aria-modal="true"
    >
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div
                x-show="isPdfModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                @click="closePdfModal()"
            ></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div
                x-show="isPdfModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
            >
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" x-text="currentPdf.title"></h3>
                        <button
                            type="button"
                            @click="closePdfModal()"
                            class="text-gray-400 hover:text-gray-500 focus:outline-none"
                        >
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="w-full h-[70vh]">
                        <iframe
                            :src="currentPdf.url"
                            class="w-full h-full border-0"
                            type="application/pdf"
                        ></iframe>
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <a
                        :href="currentPdf.url"
                        download
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-700 border border-transparent rounded-md shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        Descargar PDF
                    </a>
                    <a
                        :href="currentPdf.pageUrl"
                        target="_blank"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        Ver página completa
                    </a>
                    <button
                        type="button"
                        @click="closePdfModal()"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm"
                    >
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
