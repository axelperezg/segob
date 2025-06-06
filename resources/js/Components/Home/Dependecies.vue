<script setup>
    import { Link } from '@inertiajs/vue3'
    import { onMounted } from 'vue'

    defineProps({
        dependencies: Array,
        filter: Object,
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
            $('.segob-slider').slick(sliderConfig)
        }, 100)
    })
</script>

<template>
    <section class="py-12 -mx-4">
        <div class="container px-16 mx-auto">
            <Link
                as="h2"
                :href="route('segob-news.index')"
                class="block mb-8 text-3xl font-bold text-center hover:text-gold transition-colors hover:underline hover:cursor-pointer"
            >
                Segob
            </Link>
            <div v-if="dependencies && dependencies.length > 0" class="segob-slider">
                <div v-for="dependency in dependencies" class="px-2">
                    <Link :href="route('dependencies.show', dependency.slug)" target="_blank" rel="noopener noreferrer">
                        <img :src="dependency.image" :alt="dependency.name" class="w-full rounded-lg" />
                    </Link>
                </div>
            </div>

            <div v-else class="text-center text-gray-500 py-8">No hay dependencias disponibles en este momento.</div>
        </div>
    </section>
</template>

<style></style>
