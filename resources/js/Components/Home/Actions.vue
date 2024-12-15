<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue'

defineProps({
    actions: Array,
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#FFFFFF" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>`,
    nextArrow: `<button type="button" class="slick-next">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#FFFFFF" class="w-10 h-10">
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
        $('.actions-slider').slick(sliderConfig)
    }, 100)
})
</script>

<template>
    <section class="py-12 -mx-4 bg-gold">
        <div class="container px-16 mx-auto">
            <h2 class="mb-8 text-3xl font-medium text-center text-white">Acciones</h2>
            <div class="actions-slider">
                <div v-for="action in actions" class="px-2">
                    <Link :href="route('actions.show', action.slug)" target="_blank">
                        <img :src="action.image" :alt="action.name" class="w-full rounded-lg" />
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<style></style>
