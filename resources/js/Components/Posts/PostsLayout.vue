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
</script>

<template>
    
</template>
