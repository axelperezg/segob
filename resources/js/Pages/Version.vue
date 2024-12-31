<script setup>
import PostsLayout from '@/Components/Posts/PostsLayout.vue';

let props = defineProps({
    posts: Object,
    filters: Object,
});
</script>

<template>
    <div>
        <PostsLayout
            :posts="posts"
            :filters="filters"
            route-name="versions.index"
            title="Versiones Estenográficas"
            :route-params="{}"
            :show-content-type="false"
        />
    </div>
</template>
