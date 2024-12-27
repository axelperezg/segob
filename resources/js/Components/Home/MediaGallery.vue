<script setup>
import { onMounted } from 'vue'
import PhotoGalleryItem from './PhotoGalleryItem.vue';
import VideoItem from './VideoItem.vue';

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
        $('.photos-slider').slick(sliderConfig)
        $('.videos-slider').slick(sliderConfig)
    }, 100)
})
</script>

<template>
    <section class="py-12 -mx-4 bg-gold-lighter">
        <div class="container px-16 mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center">Fotos</h2>
            <div class="photos-slider">
                <PhotoGalleryItem
                    v-for="photo in photos"
                    :key="photo.id"
                    :item="photo"
                />
            </div>

            <h2 class="mt-12 mb-8 text-3xl font-bold text-center">Videos</h2>
            <div class="videos-slider">
                <VideoItem
                    v-for="video in videos"
                    :key="video.id"
                    :item="video"
                />
            </div>
        </div>
    </section>
</template> 