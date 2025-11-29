@props(['photo'])

<a href="{{ route('photo-galleries.show', $photo->slug) }}" class="px-2">
    <div class="relative overflow-hidden rounded-lg aspect-video">
        <img src="{{ $photo->getFirstMediaUrl('image') }}" 
             alt="{{ $photo->name }}" 
             class="object-cover w-full h-full" />
    </div>
    <div class="mt-3">
        <h3 class="font-bold text-lg">{{ $photo->name }}</h3>
        <p class="text-sm text-gray-600">{{ App\Helpers\DateHelper::formatSpanishDate($photo->published_at) }}</p>
    </div>
</a>

