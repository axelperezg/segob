<script setup>
    import { Link } from '@inertiajs/vue3'
    import { onMounted } from 'vue'

    const props = defineProps(['dependencies'])

    const sliderConfig = {
        dots: true,
        infinite: true,
        arrows: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        centerPadding: '20px',
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
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    }

    onMounted(() => {
        if (props.dependencies?.data?.length) {
            setTimeout(() => {
                $('.dependencies-slider').slick(sliderConfig)
            }, 100)
        }
    })
</script>

<template>
    <div class="pt-10 my-12">
        <h2 class="my-10 text-3xl font-bold text-center">Segob</h2>
        <div v-if="dependencies.data.length === 0" class="py-8 text-center">
            <p class="text-xl text-gray-600">No hay dependencias disponibles en este momento.</p>
        </div>
        <div v-else class="px-2 dependencies-slider">
            <div v-for="dependency in dependencies.data" :key="dependency.id" class="px-2">
                <Link :href="route('dependencies.show', dependency.slug)" target="_blank" rel="noopener noreferrer">
                    <div class="flex flex-col items-center">
                        <div class="overflow-hidden">
                            <img :src="dependency.image" :alt="dependency.name" class="object-contain w-full h-full" />
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
