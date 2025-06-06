<script setup>
    import PhotoGalleryPresenter from '@/Presenters/PhotoGalleryPresenter'
    import { Link } from '@inertiajs/vue3'

    const props = defineProps({
        item: {
            type: Object,
            required: true,
        },
    })

    const photo = new PhotoGalleryPresenter(props.item)
</script>

<template>
    <Link :href="route('photo-galleries.show', photo.slug)" class="px-2">
        <div class="relative overflow-hidden rounded-lg aspect-video">
            <img :src="photo.thumbnail" :alt="photo.name" class="object-cover w-full h-full" />
        </div>
        <div class="mt-3">
            <h3 class="font-bold text-lg">{{ photo.name }}</h3>
            <p class="text-sm text-gray-600">{{ photo.published_at }}</p>
        </div>
    </Link>
</template>
