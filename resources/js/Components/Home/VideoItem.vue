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
        <div class="relative overflow-hidden rounded-lg aspect-video">
            <img :src="video.thumbnail" :alt="video.title" class="object-cover w-full h-full">
        </div>
        <div class="mt-3">
            <h3 class="font-bold text-lg">{{ video.title }}</h3>
            <p class="text-sm text-gray-600">{{ video.published_at }}</p>
        </div>
    </div>
</template> 