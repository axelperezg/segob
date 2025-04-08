<script setup>
import PostsLayout from '@/Components/Posts/PostsLayout.vue';
import { Link } from '@inertiajs/vue3';

let props = defineProps({
    posts: Object,
    filters: Object,
    showDependency: Boolean,
});
</script>

<template>
    <div>
        <PostsLayout :posts="posts" :filters="filters" route-name="segob-news.index" title="Noticias Segob"
            :route-params="{}" :show-dependency="showDependency" />
        <div class="mx-auto max-w-7xl">
            <div class="pt-10 my-6">
                <div class="flex flex-col justify-center gap-16 my-8 md:flex-row lg:gap-32">
                    <div class="flex flex-col items-center">
                        <div class="p-4 mb-2 border rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z" />
                            </svg>
                        </div>
                        <Link :href="route('versions.index')"
                            class="px-8 py-2 text-lg border rounded text-burgundy border-burgundy">Versiones</Link>
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="p-4 mb-2 border rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <Link :href="route('photo-galleries.index')"
                            class="px-8 py-2 text-lg border rounded text-burgundy border-burgundy">Galerías</Link>
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="p-4 mb-2 border rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <Link :href="route('videos.index')"
                            class="px-8 py-2 text-lg border rounded text-burgundy border-burgundy">Videos</Link>
                    </div>
                </div>

                <h2 class="my-10 text-3xl font-bold text-center">Segob</h2>
            </div>
        </div>
    </div>
</template>