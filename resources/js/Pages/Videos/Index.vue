<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    videos: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Videos</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="video in videos.data" :key="video.id" class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="aspect-video relative">
                    <img :src="video.thumbnail" :alt="video.title" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white opacity-75" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ video.title }}</h2>
                    <p class="text-gray-600 text-sm">{{ video.published_at }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
