<script setup>
import Actions from '@/Components/Home/Actions.vue';
import Banners from '@/Components/Home/Banners.vue';
import Dependecies from '@/Components/Home/Dependecies.vue';
import NoticiasMx from '@/Components/Home/NoticiasMx.vue';
import Infographics from '@/Components/Home/Infographics.vue';
import MediaGallery from '@/Components/Home/MediaGallery.vue';
import Contact from '@/Components/Home/Contact.vue';
import { Link } from '@inertiajs/vue3';

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
</script>

<template>
    <section class="py-8 max-w-7xl mx-auto">
        <h3 class="text-2xl font-bold lg:text-3xl">Noticias</h3>
        <div class="grid grid-cols-1 gap-6 pb-8 pt-4 lg:flex">
            <div class="space-y-6 lg:w-2/3">
                <!-- Main posts -->
                <Link :href="route('posts.show', post.slug)" v-for="post in mainPosts.data" :key="post.id">
                    <article class="overflow-hidden border rounded-lg">
                        <img :src="post.image" :alt="post.title" class="w-full" />
                        <div class="p-4">
                            <h2 class="mb-2 text-xl font-bold lg:text-4xl">{{ post.title }}</h2>
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
                            <div class="prose max-w-6xl" v-html="post.excerpt"></div>
                        </div>
                    </article>
                </Link>
            </div>
            <!-- Secondary posts -->
            <div class="space-y-6 lg:w-1/3">
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
            <Link href="/noticias" class="px-8 py-2 font-medium text-white transition-colors rounded bg-burgundy hover:bg-gold">
                Ver más
            </Link>
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
