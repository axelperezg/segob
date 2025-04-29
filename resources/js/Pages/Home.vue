<script setup>
import Actions from '@/Components/Home/Actions.vue';
import Banners from '@/Components/Home/Banners.vue';
import Dependecies from '@/Components/Home/Dependecies.vue';
import NoticiasMx from '@/Components/Home/NoticiasMx.vue';
import Infographics from '@/Components/Home/Infographics.vue';
import MediaGallery from '@/Components/Home/MediaGallery.vue';
import Contact from '@/Components/Home/Contact.vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    mainPosts: Object,
    secondaryPosts: Object,
    tertiaryPosts: Object,
    actions: Object,
    banners: Object,
    dependencies: Object,
    infographics: Object,
    mediaGallery: Object,
})

import { usePage } from '@inertiajs/vue3';

const page = usePage();
const metaTitle = page.props.app_settings.meta_title;
const metaDescription = page.props.app_settings.meta_description;

</script>

<template>

    <Head>
        <title>{{ metaTitle }}</title>
        <meta name="description" :content="metaDescription" />
    </Head>

    <section class="py-8 mx-auto max-w-7xl">
        <h3 class="text-2xl font-bold lg:text-3xl">Noticias</h3>

        <div v-if="!mainPosts.data.length && !secondaryPosts.data.length && !tertiaryPosts.data.length"
            class="py-12 text-center">
            <p class="text-xl text-gray-600">No hay noticias disponibles en este momento.</p>
        </div>

        <div v-else>
            <div class="grid grid-cols-1 gap-6 pt-4 pb-8 md:flex">
                <div class="space-y-6 md:w-8/12 lg:w-2/3">
                    <!-- Main posts -->
                    <Link :href="route('posts.show', post.slug)" v-for="post in mainPosts.data" :key="post.id">
                    <article class="overflow-hidden border rounded-lg">
                        <img :src="post.image" :alt="post.title" class="w-full" />
                        <div class="p-4">
                            <h2 class="mb-2 text-xl font-bold md:text-4xl">{{ post.title }}</h2>
                            <p class="mb-1 text-xs italic text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{
                                    new Date(post.published_at).toLocaleDateString('es-MX', {
                                        day: '2-digit',
                                        month: '2-digit',
                                        year: 'numeric',
                                    })
                                }}
                            </p>
                            <div class="max-w-6xl prose" v-html="post.excerpt"></div>
                        </div>
                    </article>
                    </Link>
                </div>
                <!-- Secondary posts -->
                <div class="space-y-6 md:w-4/12 lg:w-1/3">
                    <Link :href="route('posts.show', post.slug)" v-for="post in secondaryPosts.data" :key="post.id">
                    <article class="overflow-hidden border rounded-lg">
                        <img :src="post.image" :alt="post.title" class="w-full" />
                        <div class="p-4">
                            <h2 class="mb-2 text-lg font-bold leading-tight">{{ post.title }}</h2>
                            <p class="mb-1 text-xs italic text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{
                                    new Date(post.published_at).toLocaleDateString('es-MX', {
                                        day: '2-digit',
                                        month: '2-digit',
                                        year: 'numeric',
                                    })
                                }}
                            </p>
                        </div>
                    </article>
                    </Link>
                </div>
            </div>

            <!-- Tertiary posts -->
            <div class="space-y-6 md:grid md:grid-cols-2 md:gap-6 md:space-y-0 lg:grid-cols-3">
                <Link :href="route('posts.show', post.slug)" v-for="post in tertiaryPosts.data" :key="post.id">
                <article class="overflow-hidden border rounded-lg">
                    <img :src="post.image" :alt="post.title" class="w-full" />
                    <div class="p-4">
                        <h2 class="mb-2 text-lg font-bold">{{ post.title }}</h2>
                        <p class="mb-1 text-xs italic text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{
                                new Date(post.published_at).toLocaleDateString('es-MX', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric',
                                })
                            }}
                        </p>
                    </div>
                </article>
                </Link>
            </div>

            <div class="flex justify-center mt-8">
                <Link :href="route('news.index')"
                    class="px-8 py-2 font-medium text-white transition-colors rounded bg-burgundy hover:bg-gold">
                Ver más
                </Link>
            </div>
        </div>
    </section>

    <Actions :actions="actions.data" />

    <Banners :banners="banners.data" />

    <Dependecies :dependencies="dependencies.data" />

    <NoticiasMx />

    <Infographics :infographics="infographics.data" />

    <MediaGallery :photos="mediaGallery.photos.data" :videos="mediaGallery.videos.data" />

    <Contact />
</template>
