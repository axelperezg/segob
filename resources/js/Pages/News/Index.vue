<script setup>
    import PostsLayout from '@/Components/Posts/PostsLayout.vue'
    import { Head } from '@inertiajs/vue3'

    let props = defineProps({
        posts: Object,
        filters: Object,
        showDependency: Boolean,
    })
</script>

<template>
    <div>
        <Head>
            <title>Noticias</title>
        </Head>

        <PostsLayout
            :posts="posts"
            :filters="filters"
            route-name="news.index"
            title="Noticias"
            :route-params="{}"
            :show-dependency="showDependency"
        />
    </div>
</template>
