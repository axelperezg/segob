<script setup>
import { ref } from 'vue';

// Fake news data to display
const newsItems = ref([
    {
        id: 1,
        time: '14:11 h',
        category: 'GN-GQB',
        title: 'En Nayarit, Guardia Nacional asegura armas largas, granadas de fragmentación, cartuchos y diverso material bélico',
        image: 'https://placehold.co/600x400/gray/white?text=Armas+Aseguradas',
        hasImage: true,
        hasPdf: true,
        featured: true
    },
    {
        id: 2,
        time: '13:32 h',
        category: 'SALUD',
        title: 'Seguridad del paciente evita bajas laborales, días extra de estancia hospitalaria y daños irreversibles a la salud',
        image: 'https://placehold.co/600x400/lightblue/white?text=Salud',
        hasImage: true,
        hasPdf: true,
        featured: false
    },
    {
        id: 3,
        time: '14:11 h',
        category: 'GN-GQB',
        title: 'En Campeche, Guardia Nacional asegura vehículo de carga con 21.6 toneladas de carbón vegetal',
        image: 'https://placehold.co/600x400/darkgray/white?text=Carbón+Vegetal',
        hasImage: true,
        hasPdf: true,
        featured: false
    },
    {
        id: 4,
        time: '12:28 h',
        category: 'CULTURA',
        title: 'El Sistema Creación pública resultados de México en Escena-Grupos Artísticos (MEGA) 2024',
        hasImage: false,
        hasPdf: true
    },
    {
        id: 5,
        time: '12:02 h',
        category: 'SECTUR',
        title: 'Llegan a México más de 48 millones de turistas a cuartos de hotel durante enero-julio de 2024',
        hasImage: false,
        hasPdf: true
    },
    {
        id: 6,
        time: '11:43 h',
        category: 'IMSS-GQB',
        title: 'Garantiza IMSS-Bienestar seguridad y calidad en atención médica a pacientes',
        hasImage: false,
        hasPdf: true
    },
    {
        id: 7,
        time: '11:04 h',
        category: 'CULTURA',
        title: 'La Fonoteca Nacional celebra 50 años de la fundación del trío Los Panchos con una sesión de escucha',
        hasImage: false,
        hasPdf: true
    },
    {
        id: 8,
        time: '10:58 h',
        category: 'ISSSTE-GQB',
        title: 'Inaugura Issste acelerador lineal y actualiza tres más para mejorar atención en CMN "20 de Noviembre"',
        hasImage: false,
        hasPdf: true
    }
]);
</script>

<template>
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <h1 class="mb-8 text-3xl font-bold text-gray-800">Noticias México</h1>

        <!-- Main two-column layout -->
        <div class="flex flex-col md:flex-row md:gap-6">
            <!-- Left column - wider, with featured post at top and two columns below -->
            <div class="w-full md:w-2/3">
                <!-- Featured post (large) -->
                <div class="mb-6">
                    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                        <div class="relative">
                            <img :src="newsItems[0].image" :alt="newsItems[0].title" class="object-cover w-full h-80">
                            <div class="absolute bottom-0 left-0 flex items-center p-2 bg-white">
                                <span class="text-sm text-gray-600">{{ newsItems[0].time }}</span>
                            </div>
                            <div class="absolute top-0 right-0 px-2 py-1 text-xs text-white bg-red-700">
                                {{ newsItems[0].category }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="mb-3 text-xl font-semibold text-gray-800">{{ newsItems[0].title }}</h2>
                            <div v-if="newsItems[0].hasPdf" class="flex items-center text-gray-600 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                                <span class="text-sm">Descargar PDF</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Two columns below the featured post -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Second post with image -->
                    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                        <div class="relative">
                            <img :src="newsItems[1].image" :alt="newsItems[1].title" class="object-cover w-full h-48">
                            <div class="absolute bottom-0 left-0 flex items-center p-2 bg-white">
                                <span class="text-sm text-gray-600">{{ newsItems[1].time }}</span>
                            </div>
                            <div class="absolute top-0 right-0 px-2 py-1 text-xs text-white bg-red-700">
                                {{ newsItems[1].category }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="mb-3 text-lg font-semibold text-gray-800">{{ newsItems[1].title }}</h2>
                            <div v-if="newsItems[1].hasPdf" class="flex items-center text-gray-600 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                                <span class="text-sm">Descargar PDF</span>
                            </div>
                        </div>
                    </div>

                    <!-- Third post with image -->
                    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                        <div class="relative">
                            <img :src="newsItems[2].image" :alt="newsItems[2].title" class="object-cover w-full h-48">
                            <div class="absolute bottom-0 left-0 flex items-center p-2 bg-white">
                                <span class="text-sm text-gray-600">{{ newsItems[2].time }}</span>
                            </div>
                            <div class="absolute top-0 right-0 px-2 py-1 text-xs text-white bg-red-700">
                                {{ newsItems[2].category }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="mb-3 text-lg font-semibold text-gray-800">{{ newsItems[2].title }}</h2>
                            <div v-if="newsItems[2].hasPdf" class="flex items-center text-gray-600 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                                <span class="text-sm">Descargar PDF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right column - narrower with stacked text items -->
            <div class="w-full mt-6 md:mt-0 md:w-1/3">
                <div class="flex flex-col space-y-4">
                    <div v-for="item in newsItems.slice(3)" :key="item.id"
                        class="p-4 border border-gray-200 rounded-md shadow-sm">
                        <div class="flex items-center mb-2 space-x-1">
                            <div class="flex items-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">{{ item.time }}</span>
                            </div>
                            <div class="text-sm font-medium text-red-700">{{ item.category }}</div>
                        </div>
                        <h2 class="mb-3 text-lg font-semibold text-gray-800">{{ item.title }}</h2>
                        <div v-if="item.hasPdf" class="flex items-center text-gray-600 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            <span class="text-sm">Descargar PDF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-10">
            <nav class="inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <a href="#"
                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                    <span class="sr-only">Previous</span>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" aria-current="page"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-700 border border-gray-300">1</a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">2</a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">3</a>
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300">...</span>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">8</a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">9</a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">10</a>
                <a href="#"
                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                    <span class="sr-only">Next</span>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </nav>
        </div>
    </div>
</template>

<style scoped>
/* You can add custom styles here if needed */
</style>
