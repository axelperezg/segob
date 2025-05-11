<script setup>
    import { ref, watch, onMounted } from 'vue'

    const props = defineProps({
        isOpen: {
            type: Boolean,
            default: false,
        },
        pdfUrl: {
            type: String,
            required: true,
        },
        pageUrl: {
            type: String,
            required: true,
        },
        title: {
            type: String,
            default: 'Comunicado',
        },
    })

    const emit = defineEmits(['close'])

    const close = () => {
        emit('close')
    }

    // Close modal when escape key is pressed
    onMounted(() => {
        const handleEscape = (e) => {
            if (e.key === 'Escape' && props.isOpen) {
                close()
            }
        }
        document.addEventListener('keydown', handleEscape)
        return () => {
            document.removeEventListener('keydown', handleEscape)
        }
    })
</script>

<template>
    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="relative w-full max-w-4xl p-1 bg-white rounded-lg shadow-xl max-h-[90vh]">
            <!-- Header -->
            <div class="flex items-center justify-between p-2 bg-gray-100 rounded-t-lg">
                <h3 class="text-lg font-semibold text-gray-800">{{ title }}</h3>
                <button @click="close" class="p-1 text-gray-600 transition-colors rounded-full hover:bg-gray-200">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <!-- PDF Viewer -->
            <div class="h-[70vh] overflow-hidden">
                <iframe :src="pdfUrl" class="w-full h-full" frameborder="0"></iframe>
            </div>

            <!-- Footer with buttons -->
            <div class="flex justify-center p-4 space-x-4 border-t border-gray-200">
                <a
                    :href="pdfUrl"
                    target="_blank"
                    download
                    class="flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-red-700 rounded-md hover:bg-red-800"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"
                        />
                    </svg>
                    Descargar PDF
                </a>
                <a
                    :href="pageUrl"
                    target="_blank"
                    class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-md hover:bg-gray-200"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                        />
                    </svg>
                    Visitar página
                </a>
                <button
                    @click="close"
                    class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-md hover:bg-gray-200"
                >
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</template>
