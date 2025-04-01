<script setup>
import PostsLayout from '@/Components/Posts/PostsLayout.vue';

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
    </div>
</template>