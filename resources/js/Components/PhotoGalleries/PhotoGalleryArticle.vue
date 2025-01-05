<script setup>
import PhotoGalleryPresenter from '@/Presenters/PhotoGalleryPresenter';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    gallery: {
        type: Object,
        required: true,
    },
});

const photoGalleryPresenter = new PhotoGalleryPresenter(props.gallery);
</script>

<template>
    <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
        <Link :href="route('photo-galleries.show', gallery.slug)" class="block">
            <div class="aspect-w-16 aspect-h-9 bg-gray-100">
                <img v-if="gallery.image" :src="gallery.image" :alt="gallery.name"
                    class="w-full h-full object-cover" />
                <div v-else class="w-full h-full flex items-center justify-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900 mb-1">{{ photoGalleryPresenter.name }}</h2>
                <div class="flex items-center text-sm text-gray-500 space-x-4">
                    <span>{{ photoGalleryPresenter.published_at }}</span>
                </div>
            </div>
        </Link>
    </article>
</template>
