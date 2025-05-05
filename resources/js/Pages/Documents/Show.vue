<script setup>
import DocumentPresenter from '@/Presenters/DocumentPresenter';
import PostPresenter from '@/Presenters/PostPresenter';
import { Link, Head } from '@inertiajs/vue3';
import { ref, onMounted, defineAsyncComponent } from 'vue';
const VuePdfEmbed = defineAsyncComponent(() => import('vue-pdf-embed'));
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
import $ from 'jquery';
import JSZip from 'jszip';

let props = defineProps(['document']);

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

const downloadGallery = () => {
    // Crear un archivo ZIP con todas las imágenes
    const zip = new JSZip();
    const img = zip.folder("images");

    // Descargar cada imagen y agregarla al ZIP
    props.document.data.images.forEach((imageUrl, index) => {
        fetch(imageUrl)
            .then(response => response.blob())
            .then(blob => {
                img.file(`image-${index + 1}.jpg`, blob);
                if (index === props.document.data.images.length - 1) {
                    zip.generateAsync({ type: "blob" })
                        .then(content => {
                            const url = window.URL.createObjectURL(content);
                            const link = document.createElement('a');
                            link.href = url;
                            link.download = `${documentPresent.name}-galeria.zip`;
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            window.URL.revokeObjectURL(url);
                        });
                }
            });
    });
};

onMounted(async () => {
    if (typeof window !== 'undefined') {
        await import('slick-carousel');
        $('.document-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: true,
            adaptiveHeight: true,
            prevArrow: `<button type="button" class="slick-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#C59426" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>`,
            nextArrow: `<button type="button" class="slick-next">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#C59426" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>`,
        });
    }
});
</script>

<template>

    <Head>
        <title>{{ documentPresent.name }} - Segob</title>
    </Head>

    <div class="container mx-auto py-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg border border-gray-100 shadow-lg py-6 px-12">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ documentPresent.name }}
                    </h1>
                    <p class="text-gray-600 mb-6">
                        {{ documentPresent.published_at }}
                    </p>

                    <div v-if="!document.data.isInfographic">
                        <div class="bg-gray-100 rounded-lg p-4 mb-6" style="min-height: 600px">
                            <client-only>
                                <VuePdfEmbed ref="pdfComponent" :source="documentPresent.document_file"
                                    :page="currentPage" @loaded="handleDocumentLoad" class="w-full h-full" />
                            </client-only>
                        </div>

                        <div class="flex flex-col space-y-4 items-center justify-between">
                            <div class="flex gap-4">
                                <button @click="previousPage" :disabled="currentPage === 1" :class="[
                                    'px-6 py-2 bg-white border-2 border-red-700 text-red-700 rounded-md transition-colors',
                                    currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-50'
                                ]">
                                    Anterior
                                </button>
                                <button @click="nextPage" :disabled="currentPage === totalPages" :class="[
                                    'px-6 py-2 bg-white border-2 border-red-700 text-red-700 rounded-md transition-colors',
                                    currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-50'
                                ]">
                                    Siguiente
                                </button>
                                <button @click="downloadPDF"
                                    class="px-6 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 transition-colors">
                                    Descargar
                                </button>
                            </div>
                            <div class="text-gray-600">
                                Página: {{ currentPage }} de {{ totalPages }}
                            </div>
                        </div>
                    </div>
                    <div :class="{ 'pt-24': !document.data.isInfographic }">
                        <div class="document-slider">
                            <div v-for="image in document.data.images" :key="image.id" class="px-2">
                                <img :src="image" class="w-full rounded-lg"
                                    style="max-height: 600px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-100 shadow p-6 mb-4">
                    <div class="space-y-4">
                        <!-- Botón de PDF (siempre visible excepto en infografías) -->
                        <button v-if="!document.data.isInfographic" @click="downloadPDF"
                            class="w-full px-6 py-3 bg-burgundy text-white rounded-md hover:bg-burgundy-soft transition-colors flex items-center justify-center gap-2">
                            <span>Descargar PDF</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </button>

                        <!-- Botón de Galería (visible en infografías o si tiene imágenes) -->
                        <button v-if="document.data.isInfographic || document.data.images?.length > 0"
                            @click="downloadGallery"
                            class="w-full px-6 py-3 bg-burgundy text-white rounded-md hover:bg-burgundy-soft transition-colors flex items-center justify-center gap-2">
                            <span>Descargar Galería</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div v-if="document.data.posts.length > 0"
                    class="bg-white rounded-lg border border-gray-100 shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Contenido relacionado</h2>

                    <div class="mb-2">
                        <div class="divide-y divide-gray-200">
                            <div v-for="post in document.data.posts" class="py-3">
                                <Link :href="route('posts.show', post.slug)"
                                    class="block hover:bg-gray-50 rounded-lg transition-colors">
                                <h3 class="font-semibold text-gray-700">
                                    {{ new PostPresenter(post).title }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ new PostPresenter(post).publishedAt }}
                                </p>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
