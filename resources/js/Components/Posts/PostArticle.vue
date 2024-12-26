<script setup>
import { Link } from '@inertiajs/vue3';
import PostPresenter from '@/Presenters/PostPresenter';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

const presenter = new PostPresenter(props.post);
</script>

<template>
    <Link :href="route('posts.show', { post: presenter.slug })" class="hover:opacity-95">
        <article class="flex flex-col gap-6 border-b border-gray-200 pb-6 md:flex-row">
            <img :src="presenter.featuredImage" :alt="presenter.title" class="w-48 h-32 object-cover rounded">
            <div>
                <h2 class="text-xl font-medium mt-1">{{ presenter.title }}</h2>
                <div class="flex flex-col gap-2 mt-2 text-sm text-gray-600">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ presenter.formattedDate }}
                    </span>
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 448 512">
                            <path class="fill-gray-600" d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/>
                        </svg>
                        {{ presenter.createdBy }}
                    </span>
                </div>
            </div>
        </article>
    </Link>
</template> 