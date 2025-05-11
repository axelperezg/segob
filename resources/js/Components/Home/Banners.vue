<script setup>
    import { onMounted } from 'vue'

    defineProps({
        banners: Array,
    })

    const sliderConfig = {
        dots: true,
        infinite: true,
        arrows: true,
        speed: 500,
        slidesToShow: 1,
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
            $('.banner-slider').slick(sliderConfig)
        }, 100)
    })
</script>

<template>
    <section class="py-12 -mx-4">
        <div class="container px-16 mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center">Banner</h2>

            <div v-if="banners && banners.length > 0" class="banner-slider">
                <div v-for="banner in banners" class="px-2">
                    <a :href="banner.external_url" target="_blank" rel="noopener noreferrer">
                        <img :src="banner.image" :alt="banner.title" class="w-full rounded-lg" />
                    </a>
                </div>
            </div>

            <div v-else class="py-8 text-center text-gray-500">No hay banners disponibles en este momento.</div>
        </div>
    </section>
</template>

<style></style>
