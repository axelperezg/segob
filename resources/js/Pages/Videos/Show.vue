<script setup>
import VideoPresenter from '@/Presenters/VideoPresenter';
import PostPresenter from '@/Presenters/PostPresenter';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    video: {
        type: Object,
        required: true,
    },
});

const videoPresent = new VideoPresenter(props.video.data);
</script>

<template>
    <div class="container mx-auto py-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg border border-gray-100 shadow-lg p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ videoPresent.title }}
                    </h1>
                    <p class="text-gray-600 mb-6">
                        {{ videoPresent.published_at }}
                    </p>

                    <div class="video-container aspect-video mb-6">
                        <iframe :src="videoPresent.url.replace('watch?v=', 'embed/')" class="w-full h-full rounded-lg"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-100 shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Contenido relacionado</h2>
                    <div class="mb-2">
                        <div class="divide-y divide-gray-200">
                            <div v-for="post in props.video.data.posts" :key="post.id" class="py-3">
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
