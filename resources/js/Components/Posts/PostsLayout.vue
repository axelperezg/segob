<script setup>
import { ref, watch } from 'vue';
import PostArticle from '@/Components/Posts/PostArticle.vue';
import { throttle } from 'lodash';
import { router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { useContentTypes } from '@/Composables/useContentTypes';

const props = defineProps({
    posts: Object,
    routeName: String,
    routeParams: {
        type: Object,
        required: true,
        default: {},
    },
    filters: Object,
    title: {
        type: String,
        required: false,
    },
});

let { contentTypes } = useContentTypes();

let contentTypesSelected = ref(props.filters.content_type);
let search = ref(props.filters.title);
let publishedAt = ref(props.filters.published_at);

let queryString = {
    title: search.value,
    published_at: publishedAt.value,
    content_type: contentTypesSelected.value,
}

const throttledSearch = throttle((value) => {
    queryString.title = value
    router.get(route(props.routeName, props.routeParams), queryString, {
        preserveState: true,
        preserveScroll: true,
    });
}, 500);

let clearFilters = () => {
    router.get(route(props.routeName, props.routeParams), {}, {
        preserveScroll: true,
    });
}

watch(search, throttledSearch);

watch(contentTypesSelected, (value) => {
    queryString.content_type = value   
    router.get(route(props.routeName, props.routeParams), queryString, {
        preserveState: true,
        preserveScroll: true,
    });
});

watch(publishedAt, (value) => {
    queryString.published_at = value
    router.get(route(props.routeName, props.routeParams), queryString, {
        preserveState: true,
        preserveScroll: true,
    });
});

const handlePageChange = (url) => {
    router.get(url, queryString, {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="max-w-7xl mx-auto">
        <!-- Search and filters grid -->
        <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
            <!-- Left sidebar -->
            <div class="space-y-6">
                <div class="bg-gray-100 shadow px-4 py-8 rounded-lg space-y-6">
                    <!-- Search -->
                    <div>
                        <h2 class="text-3xl mb-2 font-bold">Busqueda</h2>
                        <div class="relative">
                            <input v-model="search" type="text" placeholder="Ingresa una palabra clave"
                                class="block w-full rounded-md bg-white px-3 py-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <!-- Filters -->
                    <div>
                        <h2 class="text-xl mb-4 font-medium">Tipo de Contenido</h2>
                        <div class="space-y-2">
                            <div v-for="(type, index) in contentTypes" :key="index" class="flex items-center gap-2">
                                <input :value="type.id" type="checkbox" :id="`type-${index}`" class="segob-checkbox" v-model="contentTypesSelected">
                                <label class="font-medium" :for="`type-${index}`">{{ type.name }}</label>
                            </div>
                        </div>
                    </div>

                    <!-- Date filter -->
                    <div>
                        <h2 class="text-xl mb-4">Fecha</h2>
                        <input type="date"
                            v-model="publishedAt"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black">
                    </div>

                    <button
                        type="button"
                        class="w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-md transition-colors"
                        @click="clearFilters"
                    >
                        Limpiar filtros
                    </button>
                </div>
            </div>

            <!-- Right content -->
            <div>
                <h1 class="text-3xl font-medium mb-8">{{ title }}</h1>
                <div class="space-y-6">
                    <div v-if="!posts.data.length" class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay publicaciones disponibles
                    </div>
                    <PostArticle v-else v-for="post in posts.data" :key="post.id" :post="post" />
                    
                    <!-- Add pagination component -->
                    <Pagination 
                        v-if="posts.meta.links.length > 3"
                        :links="posts.meta.links"
                        @page-changed="handlePageChange"
                        class="mt-6"
                    />
                </div>
            </div>
        </div>
    </div>
</template> 