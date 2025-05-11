<script setup>
    import VideoPresenter from '@/Presenters/VideoPresenter'
    import { Link } from '@inertiajs/vue3'

    const props = defineProps({
        item: {
            type: Object,
            required: true,
        },
    })

    const video = new VideoPresenter(props.item)
</script>

<template>
    <Link :href="route('videos.show', item.slug)" class="px-2">
        <div class="relative overflow-hidden rounded-lg aspect-video">
            <img :src="video.image" :alt="video.title" class="object-cover w-full h-full" />
        </div>
        <div class="mt-3">
            <h3 class="font-bold text-lg">{{ video.title }}</h3>
            <p class="text-sm text-gray-600">{{ video.published_at }}</p>
        </div>
    </Link>
</template>
