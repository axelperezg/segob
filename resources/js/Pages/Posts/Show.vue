<script setup>
import PostPresenter from '@/Presenters/PostPresenter';
import { ref } from 'vue';

let props = defineProps({
    post: Object,
});

const postPresenter = new PostPresenter(props.post.data);
const activeTab = ref(1);
</script>

<template>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-medium">{{ postPresenter.title }}</h1>
        <div class="pt-3">
            <p class="text-sm text-burgundy-soft flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path class="fill-gray-700"
                        d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l352 0 0 256c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256z" />
                </svg>
                {{ postPresenter.publishedAt }}
            </p>
        </div>

        <section class="py-8 flex justify-center">
            <img class="w-full" :src="postPresenter.featuredImage" alt="Featured Image" />
        </section>


        <div class="pb-4">
            <div class="border-b border-gray-200">
                <nav class="flex flex-col md:flex-row gap-6">
                    <button
                        @click="activeTab = 1"
                        :class="[
                            'py-2 font-[400] text-lg border-b-4 transition-colors',
                            activeTab === 1 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                        ]"
                    >
                        {{ postPresenter.contentType }}
                    </button>
                    <button
                        v-if="postPresenter.hasPhotos"
                        @click="activeTab = 2"
                        :class="[
                            'py-2 font-[400] text-lg border-b-4 transition-colors',
                            activeTab === 2 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                        ]"
                    >
                        Fotografías
                    </button>
                    <button
                        v-if="postPresenter.hasAudio"
                        @click="activeTab = 3"
                        :class="[
                            'py-2 font-[400] text-lg border-b-4 transition-colors',
                            activeTab === 3 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                        ]"
                    >
                        Audio
                    </button>
                    <button
                        v-if="postPresenter.hasDocument"
                        @click="activeTab = 4"
                        :class="[
                            'py-2 font-[400] text-lg border-b-4 transition-colors',
                            activeTab === 4 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                        ]"
                    >
                        Documento
                    </button>
                    <button
                        v-if="postPresenter.hasVideo"
                        @click="activeTab = 5"
                        :class="[
                            'py-2 font-[400] text-lg border-b-4 transition-colors',
                            activeTab === 5 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                        ]"
                    >
                        Video
                    </button>
                    <button
                        v-if="postPresenter.hasStenographicVersion"
                        @click="activeTab = 6"
                        :class="[
                            'py-2 font-[400] text-lg border-b-4 transition-colors',
                            activeTab === 6 ? 'border-gold' : 'border-transparent hover:border-gold/50'
                        ]"
                    >
                        Versión Estenográfica
                    </button>
                </nav>
            </div>

            <div class="mt-4">
                <div v-show="activeTab === 1">
                    <div class="prose-lg max-w-7xl" v-html="postPresenter.content">
                    </div>
                    <div class="flex justify-center">
                        <div class="flex flex-wrap gap-2 items-center border-l border-gray-400 pl-2 mt-10">
                            <span v-for="dependency in postPresenter.dependencies" :key="dependency.id" class="text-sm italic font-normal">
                                {{ dependency.name }}{{ !$last ? ',' : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="pt-10" v-if="postPresenter.contentType === 'Boletín'">
                    <p class="text-lg font-bold">Boletín No. {{ postPresenter.bulletin }}</p>
                </div>

                <div class="grid grid-cols-3 gap-4" v-show="activeTab === 2">
                    <a
                        v-for="photo in post.data.photoGallery?.photos"
                        :href="photo"
                        :download="true"
                    >
                        <img class="rounded-md" :src="photo" :alt="postPresenter.name" />
                    </a>
                </div>
                <div v-show="activeTab === 4" class="w-full h-screen">
                    <iframe
                        :src="post.data.document?.document_file"
                        class="w-full h-[80vh]"
                        type="application/pdf"
                    >
                    </iframe>
                    <div class="flex justify-center mb-4 mt-10">
                        <a
                            :href="post.data.document?.document_file"
                            download
                            class="bg-gold hover:bg-gold/90 text-lg text-white font-medium py-2 px-4 rounded inline-flex items-center"
                        >
                            <span>Descargar PDF</span>
                        </a>
                    </div>
                </div>
                <div v-show="activeTab === 3" class="max-w-3xl mx-auto">
                    <div v-if="post.data?.audio" class="flex flex-col items-center">
                        <audio
                            controls
                            class="w-full"
                        >
                            <source :src="post.data.audio.audio_file" type="audio/mpeg">
                            Tu navegador no soporta el elemento de audio.
                        </audio>
                        <div class="flex justify-center mb-4 mt-10">
                            <a
                                :href="post.data.audio.audio_file"
                                download
                                class="bg-gold hover:bg-gold/90 text-lg text-white font-medium py-2 px-4 rounded inline-flex items-center"
                            >
                                <span>Descargar Audio</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div v-show="activeTab === 5" class="max-w-5xl mx-auto h-screen">
                    <div v-if="post.data?.video" class="flex flex-col items-center">
                        <div class="relative w-full pt-[56.25%]">
                            <iframe
                                :src="`https://www.youtube.com/embed/${post.data.video.url.split('v=')[1]}`"
                                class="absolute top-0 left-0 w-full h-full"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                </div>
                <div v-show="activeTab === 6" class="max-w-5xl mx-auto">
                    <div v-if="post.data?.stenographicVersion" class="prose-lg">
                        <div v-html="post.data.stenographicVersion.content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
