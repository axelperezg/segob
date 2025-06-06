<script setup>
    import PostsLayout from '@/Components/Posts/PostsLayout.vue'
    import { Head } from '@inertiajs/vue3'

    let props = defineProps({
        posts: Object,
        filters: Object,
    })
</script>

<template>
    <Head>
        <title>Versiones Estenográficas - Segob</title>
    </Head>

    <PostsLayout
        :posts="posts"
        :filters="filters"
        route-name="versions.index"
        title="Versiones Estenográficas"
        :route-params="{}"
        :show-content-type="false"
    />
</template>
