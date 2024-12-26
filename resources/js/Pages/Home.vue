<script setup>
import Actions from '@/Components/Home/Actions.vue';
import Banners from '@/Components/Home/Banners.vue';
import Dependecies from '@/Components/Home/Dependecies.vue';
import NoticiasMx from '@/Components/Home/NoticiasMx.vue';

defineProps({
    mainPosts: Object,
    secondaryPosts: Object,
    tertiaryPosts: Object,
    actions: Object,
    banners: Object,
    dependencies: Object,
})
</script>

<template>
    <section class="py-8 max-w-7xl mx-auto">
        <h3 class="text-2xl font-bold lg:text-3xl">Noticias</h3>
        <div class="grid grid-cols-1 gap-6 pb-8 pt-4 lg:flex">
            <div class="space-y-6 lg:w-2/3">
                <!-- Main posts -->
                <a :href="route('posts.show', post.slug)" v-for="post in mainPosts" :key="post.id"
                    class="overflow-hidden border rounded-lg">
                    <article>
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
                            <div v-html="post.content"></div>
                        </div>
                    </article>
                </a>
            </div>
            <!-- Secondary posts -->
            <div class="space-y-6 lg:w-1/3">
                <a :href="route('posts.show', post.slug)" v-for="post in secondaryPosts" :key="post.id"
                    class="overflow-hidden border rounded-lg">
                    <article>
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
                </a>
            </div>
        </div>

        <div class="space-y-6 md:grid md:grid-cols-2 md:gap-6 md:space-y-0 lg:grid-cols-3">
            <a :href="route('posts.show', post.slug)" v-for="post in tertiaryPosts" :key="post.id"
                class="overflow-hidden border rounded-lg">
                <article>
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
            </a>
        </div>

        <div class="flex justify-center mt-8">
            <button class="px-8 py-2 font-medium text-white transition-colors rounded bg-burgundy hover:bg-gold">
                Ver más
            </button>
        </div>
    </section>
    <!-- Actions -->
    <Actions :actions="actions.data" />

    <!-- Banners -->
    <Banners :banners="banners.data" />

    <!-- Segob(dependencies) -->
    <Dependecies :dependencies="dependencies.data" />

    <NoticiasMx />
</template>
