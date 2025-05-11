<script setup>
import DocumentArticle from '@/Components/Documents/DocumentArticle.vue'
import Pagination from '@/Components/Pagination.vue'
import PostsFilter from '@/Components/Posts/PostsFilter.vue'
import { router, Head } from '@inertiajs/vue3'

let props = defineProps({
    documents: Object,
    filters: Object,
    documentSections: Object,
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
        <title>Documentos</title>
    </Head>

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
            <PostsFilter
                :show-content-type="false"
                :show-dependency="false"
                :show-published-at="false"
                :show-document-section="true"
                route-name="documents.index"
                :route-params="{}"
                :filters="filters"
                :document-sections="documentSections"
            />

            <div>
                <h1 class="text-3xl font-medium mb-8">Documentos</h1>
                <div class="space-y-6">
                    <div v-if="!documents.data.length" class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay documentos disponibles
                    </div>

                    <div class="grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3">
                        <DocumentArticle
                            v-if="documents.data.length"
                            v-for="document in documents.data"
                            :key="document.id"
                            :document="document"
                        />
                    </div>

                    <Pagination
                        v-if="documents.meta.links.length > 3"
                        :links="documents.meta.links"
                        @page-changed="handlePageChange"
                        class="mt-6"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
