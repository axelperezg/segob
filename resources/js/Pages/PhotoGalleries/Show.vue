<script setup>
import PhotoGalleryPresenter from '@/Presenters/PhotoGalleryPresenter';
import { onMounted } from 'vue';
// CSS imports are fine since they don't execute JavaScript
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
import $ from 'jquery';
// Remove direct import of slick-carousel
import PostPresenter from '@/Presenters/PostPresenter';
import { Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    gallery: {
        type: Object,
        required: true,
    },
});

const galleryPresent = new PhotoGalleryPresenter(props.gallery.data);

onMounted(async () => {
    // Dynamically import slick-carousel only on client-side
    if (typeof window !== 'undefined') {
        await import('slick-carousel');
        $('.photo-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: true,
            adaptiveHeight: true,
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
        });
    }
});
</script>

<template>

    <Head>
        <title>{{ galleryPresent.name }} - Segob</title>
    </Head>

    <div class="container mx-auto py-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg border border-gray-100 shadow-lg py-6 px-12">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ galleryPresent.name }}
                    </h1>
                    <p class="text-gray-600 mb-6">
                        {{ galleryPresent.published_at }}
                    </p>

                    <div class="photo-slider">
                        <div v-for="photo in galleryPresent.photos" :key="photo.id" class="px-2">
                            <img :src="photo" class="w-full rounded-lg" style="max-height: 600px; object-fit: contain;">
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="props.gallery.data.posts.length > 0" class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-100 shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Contenido relacionado</h2>
                    <div class="mb-2">
                        <div class="divide-y divide-gray-200">
                            <div v-for="post in props.gallery.data.posts" :key="post.id" class="py-3">
                                <Link :href="route('posts.show', post.slug)"
                                    class="block hover:bg-gray-50 rounded-lg transition-colors">
                                <h3 class="font-semibold text-gray-700">
                                    {{ new PostPresenter(post).title }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ new PostPresenter(post).publishedAt }}
                                </p>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
