<script setup>
    import { router, Head } from '@inertiajs/vue3'
    import Pagination from '@/Components/Pagination.vue'
    import PostsFilter from '@/Components/Posts/PostsFilter.vue'
    import InfographicArticle from '@/Components/Infographics/InfographicArticle.vue'

    let props = defineProps({
        infographics: Object,
        filters: Object,
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
        <title>Infografías</title>
    </Head>

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
            <PostsFilter
                :show-content-type="false"
                :show-dependency="false"
                :show-published-at="false"
                :show-document-section="true"
                route-name="infographics.index"
                :route-params="{}"
                :filters="filters"
            />

            <div>
                <h1 class="text-3xl font-medium mb-8">Infografías</h1>
                <div class="space-y-6">
                    <div v-if="!infographics.data.length" class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay infografías disponibles
                    </div>

                    <div class="grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3">
                        <InfographicArticle
                            v-if="infographics.data.length"
                            v-for="infographic in infographics.data"
                            :key="infographic.id"
                            :infographic="infographic"
                        />
                    </div>

                    <Pagination
                        v-if="infographics.meta.links.length > 3"
                        :links="infographics.meta.links"
                        @page-changed="handlePageChange"
                        class="mt-6"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
