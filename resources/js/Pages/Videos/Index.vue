<script setup>
    import Pagination from '@/Components/Pagination.vue'
    import PostsFilter from '@/Components/Posts/PostsFilter.vue'
    import VideoArticle from '@/Components/Videos/VideoArticle.vue'
    import { router } from '@inertiajs/vue3'
    import { Head } from '@inertiajs/vue3'
    const props = defineProps({
        videos: {
            type: Object,
            required: true,
        },
        filters: {
            type: Object,
            required: true,
        },
    })

    const handlePageChange = (url) => {
        router.get(
            url,
            {},
            {
                preserveState: true,
                preserveScroll: true,
            },
        )
    }
</script>

<template>
    <Head>
        <title>Videos - Segob</title>
    </Head>
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
            <PostsFilter
                :show-content-type="false"
                :show-dependency="false"
                :show-published-at="true"
                :show-document-section="false"
                route-name="videos.index"
                :route-params="{}"
                :filters="filters"
            />

            <div>
                <h1 class="text-3xl font-medium mb-8">Videos</h1>
                <div class="space-y-6">
                    <div v-if="!videos.data.length" class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay videos disponibles
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <VideoArticle v-for="video in videos.data" :key="video.id" :video="video" />
                    </div>

                    <Pagination
                        v-if="videos.meta.links.length > 3"
                        :links="videos.meta.links"
                        @page-changed="handlePageChange"
                        class="mt-6"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
