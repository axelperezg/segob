<script setup>
import { useContentTypes } from '@/Composables/useContentTypes';
import DependencyPresenter from '@/Presenters/DependencyPresenter';
import PostsLayout from '@/Components/Posts/PostsLayout.vue';
import { Head } from '@inertiajs/vue3';

let props = defineProps({
    posts: Object,
    dependency: Object,
    filters: Object,
});

const dependencyPresenter = new DependencyPresenter(props.dependency.data);
</script>

<template>
    <div>

        <Head>
            <title>{{ dependencyPresenter.name }} - Segob</title>
        </Head>

        <!-- Banner -->
        <div class="flex justify-center bg-[#F1EDE1] -mx-4 -mt-8 py-6 mb-8">
            <img :src="dependencyPresenter.banner" :alt="dependencyPresenter.name" class="w-[20rem]">
        </div>

        <PostsLayout :posts="posts" :filters="filters" :route-name="'dependencies.show'"
            :route-params="{ slug: dependency.data.slug }" :title="dependencyPresenter.name" />
    </div>
</template>
