@props(['video'])

<a href="{{ route('videos.show', $video->slug) }}" class="px-2">
    <div class="relative overflow-hidden rounded-lg aspect-video">
        <img src="{{ $video->getFirstMediaUrl('image') }}" 
             alt="{{ $video->title }}" 
             class="object-cover w-full h-full" />
    </div>
    <div class="mt-3">
        <h3 class="font-bold text-lg">{{ $video->title }}</h3>
        <p class="text-sm text-gray-600">{{ App\Helpers\DateHelper::formatSpanishDate($video->published_at) }}</p>
    </div>
</a>

