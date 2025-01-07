<script setup>
import VideoPresenter from '@/Presenters/VideoPresenter';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    video: {
        type: Object,
        required: true,
    },
});

const videoPresent = new VideoPresenter(props.video);
</script>

<template>
    <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
        <Link href="/" class="block">
            <div class="aspect-w-16 aspect-h-9 bg-gray-100">
                <img :src="videoPresent.image" :alt="videoPresent.title"
                    class="w-full h-full object-cover" />
            </div>

            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900 mb-1">{{ videoPresent.title }}</h2>
                <div class="flex items-center text-sm text-gray-500 space-x-4">
                    <span>{{ videoPresent.published_at }}</span>
                </div>
            </div>
        </Link>
    </article>
</template>
