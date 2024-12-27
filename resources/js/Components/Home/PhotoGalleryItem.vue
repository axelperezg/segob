<script setup>
import PhotoGalleryPresenter from '@/Presenters/PhotoGalleryPresenter';


const props = defineProps({
    item: {
        type: Object,
        required: true
    }
});

const photo = new PhotoGalleryPresenter(props.item);
</script>

<template>
    <div class="px-2">
        <div class="relative overflow-hidden rounded-lg aspect-video group">
            <img :src="photo.thumbnail" :alt="photo.name" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
            <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black/50 opacity-0 group-hover:opacity-100">
                <span class="text-xl font-bold text-white">{{ photo.name }}</span>
            </div>
        </div>
    </div>
</template> 