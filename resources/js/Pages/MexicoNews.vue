<script setup>
import { ref, computed } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    mainPosts: Object,
    posts: Object,
});

let featuredPost = props.mainPosts.data[0];
let secondaryPosts = props.mainPosts.data.slice(1, 3);
let tertiaryPosts = props.posts.data;

const selectedDate = ref(null);

// Format date helper function
const formatDate = (dateString) => {
    if (!dateString) return '';

    const date = new Date(dateString);
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');

    return `${hours}:${minutes}`;
};

const formattedSelectedDate = computed(() => {
    if (!selectedDate.value) return '';
    return formatDate(selectedDate.value);
});

const handleDateChange = () => {
    console.log(selectedDate.value);
};

const handlePageChange = (url) => {
    router.get(url, {}, {
        preserveState: true,
        preserveScroll: true,
    });
};

const clearDateFilter = () => {
    selectedDate.value = null;
};
</script>

<template>
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">Noticias México</h1>

        <!-- Date filter using input type="date" -->
        <div class="mb-8">
            <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-stretch">
                <label for="date-filter" class="font-medium text-gray-700">Filtrar por fecha:</label>
                <div class="flex w-full sm:w-auto">
                    <input type="date" id="date-filter" v-model="selectedDate" @change="handleDateChange"
                        class="px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <button v-if="selectedDate" @click="clearDateFilter"
                        class="px-3 py-2 text-white bg-red-700 rounded-r-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        title="Limpiar filtro">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Show selected date if filtering -->
            <div v-if="formattedSelectedDate" class="mt-2 text-sm text-gray-600">
                Mostrando noticias del: <span class="font-medium">{{ formattedSelectedDate }}</span>
            </div>
        </div>

        <!-- Main two-column layout -->
        <div v-if="true" class="flex flex-col md:flex-row md:gap-6">
            <!-- Left column - wider, with featured post at top and two columns below -->
            <div class="w-full md:w-2/3">
                <!-- Featured post (large) -->
                <div class="mb-6">
                    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                        <a :href="featuredPost.url" target="_blank" class="block cursor-pointer">
                            <div class="relative">
                                <img :src="featuredPost.featured_image" alt="Noticia destacada"
                                    class="object-cover w-full h-80">
                                <div class="absolute bottom-0 left-0 flex items-center p-2 bg-white">
                                    <span class="text-sm text-gray-600">{{ formatDate(featuredPost.published_at)
                                    }}</span>
                                </div>
                                <div class="absolute top-0 right-0 px-2 py-1 text-xs text-white bg-red-700">
                                    {{ featuredPost.mexicoDependency.name }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h2 class="mb-3 text-xl font-semibold text-gray-800">{{ featuredPost.title }}</h2>
                            </div>
                        </a>
                        <div class="px-4 pb-4">
                            <div class="flex items-center text-gray-600 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                                <a :href="featuredPost.pdf" target="_blank" class="text-sm">Descargar PDF</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Two columns below the featured post -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div v-for="post in secondaryPosts" :key="post.id"
                        class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                        <a :href="post.url" target="_blank" class="block cursor-pointer">
                            <div class="relative">
                                <img :src="post.featured_image" :alt="post.title" class="object-cover w-full h-48">
                                <div class="absolute bottom-0 left-0 flex items-center p-2 bg-white">
                                    <span class="text-sm text-gray-600">{{ formatDate(post.published_at) }}</span>
                                </div>
                                <div class="absolute top-0 right-0 px-2 py-1 text-xs text-white bg-red-700">
                                    {{ post.mexicoDependency.name }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h2 class="mb-3 text-lg font-semibold text-gray-800">{{ post.title }}</h2>
                            </div>
                        </a>
                        <div class="px-4 pb-4">
                            <div class="flex items-center text-gray-600 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                                <a :href="post.pdf" target="_blank" class="text-sm">Descargar PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right column - narrower with stacked text items -->
            <div class="w-full mt-6 md:mt-0 md:w-1/3">
                <div class="flex flex-col space-y-4">
                    <a v-for="post in tertiaryPosts" :key="post.id" :href="post.url" target="_blank"
                        class="p-4 transition-colors border border-gray-200 rounded-md shadow-sm hover:bg-gray-50">
                        <div class="flex items-center mb-2 space-x-1">
                            <div class="flex items-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">{{ formatDate(post.published_at) }}</span>
                            </div>
                            <div class="text-sm font-medium text-red-700">{{ post.mexicoDependency.name }}</div>
                        </div>
                        <h2 class="mb-3 text-lg font-semibold text-gray-800">{{ post.title }}</h2>
                        <div class="flex items-center text-gray-600 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            <a :href="post.pdf" target="_blank" class="text-sm" @click.stop>Descargar PDF</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Empty state when no news items match the filter -->
        <div v-else class="py-10 text-center">
            <p class="text-xl text-gray-600">No hay noticias disponibles para la fecha seleccionada.</p>
            <button @click="clearDateFilter"
                class="px-4 py-2 mt-4 text-white bg-red-700 rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Ver todas las noticias
            </button>
        </div>

        <!-- Pagination -->
        <Pagination v-if="posts.meta.links.length > 3" :links="posts.meta.links" @page-changed="handlePageChange"
            class="mt-10" />
    </div>
</template>

<style scoped>
/* Style input[type="date"] for better cross-browser appearance */
input[type="date"] {
    min-width: 200px;
}

/* Override default date input appearance in some browsers */
input[type="date"]::-webkit-calendar-picker-indicator {
    cursor: pointer;
}
</style>
