<script setup>
import VideoPresenter from '@/Presenters/VideoPresenter';

const props = defineProps({
    item: {
        type: Object,
        required: true
    }
});

const video = new VideoPresenter(props.item);
</script>

<template>
    <div class="px-2">
        <div class="relative overflow-hidden rounded-lg aspect-video group">
            <img :src="video.thumbnail" :alt="video.title" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
            <div class="absolute inset-0 flex flex-col items-center justify-center transition-opacity duration-300 bg-black/50 opacity-0 group-hover:opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347c-.75.412-1.667-.13-1.667-.986V5.653Z" />
                </svg>
                <span class="text-xl font-bold text-white">{{ video.title }}</span>
            </div>
        </div>
    </div>
</template> 