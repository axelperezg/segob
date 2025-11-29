@props(['video'])

<article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
    <a href="{{ route('videos.show', $video->slug) }}" class="block">
        <div class="aspect-w-16 aspect-h-9 bg-gray-100">
            <img
                src="{{ $video->image }}"
                alt="{{ $video->title }}"
                class="w-full h-full object-cover"
            />
        </div>

        <div class="p-4">
            <h2 class="text-lg font-medium text-gray-900 mb-1">{{ $video->title }}</h2>
            <div class="flex items-center text-sm text-gray-500 space-x-4">
                <span>{{ \App\Helpers\DateHelper::formatSpanishDate($video->published_at) }}</span>
            </div>
        </div>
    </a>
</article>
