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
    <article class="flex flex-col gap-6 py-3 border-b border-gray-200 md:flex-row">
        <img :src="presenter.featuredImage" :alt="presenter.title" class="object-cover w-48 h-32 rounded">
        <div>
            <h2 class="mt-1 text-xl font-medium">{{ presenter.title }}</h2>
            <div class="flex flex-col gap-2 mt-2 text-sm text-gray-600">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ presenter.formattedDate }}
                </span>
                <span class="flex items-center">
                    {{ presenter.dependencies }}
                </span>
            </div>
        </div>
    </article>
    </Link>
</template>
