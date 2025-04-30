<script setup>
import { onMounted } from 'vue'
import PhotoGalleryItem from './PhotoGalleryItem.vue';
import VideoItem from './VideoItem.vue';
import { Link } from '@inertiajs/vue3';

let props = defineProps({
    photos: Array,
    videos: Array
})

const sliderConfig = {
    dots: true,
    infinite: true,
    arrows: true,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    centerPadding: '100px',
    prevArrow: `<button type="button" class="slick-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#C59426" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>`,
    nextArrow: `<button type="button" class="slick-next">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#C59426" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>`,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                centerPadding: '40px',
            },
        },
        {
            breakpoint: 640,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerPadding: '20px',
            },
        },
    ],
}

onMounted(() => {
    setTimeout(() => {
        if (props.photos?.length) {
            $('.photos-slider').slick(sliderConfig)
        }
        if (props.videos?.length) {
            $('.videos-slider').slick(sliderConfig)
        }
    }, 100)
})
</script>

<template>
    <section class="py-12 -mx-4 bg-gold-lighter">
        <div class="container px-16 mx-auto">
            <Link as="h2" :href="route('photo-galleries.index')"
                class="block mb-8 text-3xl font-bold text-center hover:text-gold transition-colors hover:underline hover:cursor-pointer">
            Fotos
            </Link>
            <div v-if="!photos || photos.length === 0" class="py-8 text-center">
                <p class="text-xl text-gray-700">No hay fotos disponibles en este momento.</p>
            </div>
            <div v-else class="photos-slider">
                <PhotoGalleryItem v-for="photo in photos" :key="photo.id" :item="photo" />
            </div>

            <Link as="h2" :href="route('videos.index')"
                class="block mt-24 mb-8 text-3xl font-bold text-center hover:text-gold transition-colors hover:underline hover:cursor-pointer">
            Videos
            </Link>
            <div v-if="!videos || videos.length === 0" class="py-8 text-center">
                <p class="text-xl text-gray-700">No hay videos disponibles en este momento.</p>
            </div>
            <div v-else class="videos-slider">
                <VideoItem v-for="video in videos" :key="video.id" :item="video" />
            </div>
        </div>
    </section>
</template>