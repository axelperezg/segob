<script setup>
import Pagination from '@/Components/Pagination.vue';
import PostsFilter from '@/Components/Posts/PostsFilter.vue';
import PhotoGalleryArticle from '@/Components/PhotoGalleries/PhotoGalleryArticle.vue';
import { router } from '@inertiajs/vue3';


defineProps({
    galleries: {
        type: Object,
        required: true,
    },
    filters: {
        type: Object,
        required: true,
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
        <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
            <PostsFilter :show-content-type="false" :show-dependency="false" :show-published-at="true"
                :show-document-section="false" route-name="photo-galleries.index" :route-params="{}" :filters="filters" />

            <div>
                <h1 class="text-3xl font-medium mb-8">Galerías de fotos</h1>
                <div class="space-y-6">
                    <div v-if="!galleries.data.length" class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay galerías de fotos disponibles
                    </div>

                    <div class="grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3">
                        <PhotoGalleryArticle v-if="galleries.data.length" v-for="gallery in galleries.data"
                            :key="gallery.id" :gallery="gallery" />
                    </div>

                    <Pagination v-if="galleries.meta.links.length > 3" :links="galleries.meta.links"
                        @page-changed="handlePageChange" class="mt-6" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>