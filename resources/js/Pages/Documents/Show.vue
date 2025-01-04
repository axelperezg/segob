<script setup>
import DocumentPresenter from '@/Presenters/DocumentPresenter';
import PostPresenter from '@/Presenters/PostPresenter';
import { ref, onMounted } from 'vue';
import VuePdfEmbed from 'vue-pdf-embed';

let props = defineProps({
    document: {
        type: Object,
        required: true
    }
});

let documentPresent = new DocumentPresenter(props.document.data);
const currentPage = ref(1);
const totalPages = ref(1);
const pdfComponent = ref(null);

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const previousPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

const handleDocumentLoad = (pdfDoc) => {
    totalPages.value = pdfDoc.numPages;
};

const downloadPDF = () => {
    window.open(documentPresent.document_file, '_blank');
};
</script>

<template>
    <div class="container mx-auto py-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg border border-gray-100 shadow-lg p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ documentPresent.name }}
                    </h1>
                    <p class="text-gray-600 mb-6">
                        {{ documentPresent.published_at }}
                    </p>
                    
                    <div class="bg-gray-100 rounded-lg p-4 mb-6" style="min-height: 600px">
                        <VuePdfEmbed
                            ref="pdfComponent"
                            :source="documentPresent.document_file"
                            :page="currentPage"
                            @loaded="handleDocumentLoad"
                            class="w-full h-full"
                        />
                    </div>

                    <div class="flex flex-col space-y-4 items-center justify-between">
                        <div class="flex gap-4">
                            <button @click="previousPage"
                                :disabled="currentPage === 1"
                                :class="[
                                    'px-6 py-2 bg-white border-2 border-red-700 text-red-700 rounded-md transition-colors',
                                    currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-50'
                                ]">
                                Anterior 
                            </button>
                            <button @click="nextPage"
                                :disabled="currentPage === totalPages"
                                :class="[
                                    'px-6 py-2 bg-white border-2 border-red-700 text-red-700 rounded-md transition-colors',
                                    currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-50'
                                ]">
                                Siguiente
                            </button>
                            <button
                                @click="downloadPDF"
                                class="px-6 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 transition-colors">
                                Descargar
                            </button>
                        </div>
                        <div class="text-gray-600">
                            Página: {{ currentPage }} de {{ totalPages }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-100 shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Contenido relacionado</h2>

                    <div class="mb-2">
                        <div class="divide-y divide-gray-200">
                            <div v-for="post in document.data.posts" class="py-3">
                                <a :href="route('posts.show', post.slug)"
                                    class="block hover:bg-gray-50 rounded-lg transition-colors">
                                    <h3 class="font-semibold text-gray-700">
                                        {{ new PostPresenter(post).title }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ new PostPresenter(post).publishedAt }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>