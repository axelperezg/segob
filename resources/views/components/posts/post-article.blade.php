@props(['post'])

<a href="{{ route('posts.show', $post->slug) }}" class="hover:opacity-95">
    <article class="flex flex-col gap-6 py-3 border-b border-gray-200 md:flex-row">
        @if($post->image)
            <img
                src="{{ $post->image }}"
                alt="{{ $post->title }}"
                class="object-cover w-48 h-32 rounded"
            />
        @endif
        <div>
            <h2 class="mt-1 text-xl font-medium">{{ $post->title }}</h2>
            <div class="flex flex-col gap-2 mt-2 text-sm text-gray-600">
                <span class="flex items-center">
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
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                        />
                    </svg>
                    {{ \App\Helpers\DateHelper::formatSpanishDate($post->published_at) }}
                </span>
                @if($post->dependencies->count() > 0)
                    <span class="flex items-center">
                        {{ $post->dependencies->pluck('name')->join(', ') }}
                    </span>
                @endif
            </div>
        </div>
    </article>
</a>
