<script setup>
import PostArticle from '@/Components/Posts/PostArticle.vue';
import PostsFilter from '@/Components/Posts/PostsFilter.vue';
import Pagination from '@/Components/Pagination.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    showContentType: {
        type: Boolean,
        default: true,
    },
    showDependency: {
        type: Boolean,
        default: true,
    },
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

const handlePageChange = (url) => {
    router.get(url, {}, {
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
            <PostsFilter
                :show-content-type="showContentType"
                :show-dependency="showDependency"
                :route-name="routeName"
                :route-params="routeParams"
                :filters="filters"
            />

            <!-- Right content -->
            <div>
                <h1 class="text-3xl font-medium mb-8">{{ title }}</h1>
                <div class="space-y-6">
                    <div v-if="!posts.data.length" class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay publicaciones disponibles
                    </div>
                    <PostArticle v-else v-for="post in posts.data" :key="post.id" :post="post" />

                    <!-- Add pagination component -->
                    <Pagination v-if="posts.meta.links.length > 3" :links="posts.meta.links"
                        @page-changed="handlePageChange" class="mt-6" />
                </div>
            </div>
        </div>
    </div>
</template>
