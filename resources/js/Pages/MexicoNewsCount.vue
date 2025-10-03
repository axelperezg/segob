<script setup>
    import { ref, computed } from 'vue'
    import { router, Head } from '@inertiajs/vue3'

    const props = defineProps({
        totalCount: Number,
        yearlyCounts: Array,
        monthlyCounts: Array,
        availableYears: Array,
        availableMonths: Array,
        filters: Object,
    })

    const selectedYear = ref(props.filters.year)
    const selectedMonth = ref(props.filters.month)

    // Nombres de meses
    const monthNames = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ]

    // Aplicar filtros
    const applyFilters = () => {
        const params = {}
        
        if (selectedYear.value) {
            params.year = selectedYear.value
        }
        if (selectedMonth.value) {
            params.month = selectedMonth.value
        }

        router.get(route('mexico-news.count'), params, {
            preserveScroll: true,
        })
    }

    // Limpiar filtros
    const clearFilters = () => {
        selectedYear.value = null
        selectedMonth.value = null
        
        router.get(route('mexico-news.count'), {}, {
            preserveScroll: true,
        })
    }

    // Computed para el texto del filtro actual
    const currentFilterText = computed(() => {
        let text = 'Todas las noticias'
        
        if (selectedYear.value) {
            text = `Año ${selectedYear.value}`
            
            if (selectedMonth.value) {
                text += ` - ${monthNames[selectedMonth.value - 1]}`
            }
        }
        
        return text
    })

    // Computed para el total de noticias del año seleccionado
    const yearlyTotal = computed(() => {
        if (!selectedYear.value) return 0
        return props.yearlyCounts.find(item => item.year == selectedYear.value)?.count || 0
    })

    // Computed para el total de noticias del mes seleccionado
    const monthlyTotal = computed(() => {
        if (!selectedYear.value || !selectedMonth.value) return 0
        return props.monthlyCounts.find(item => item.month == selectedMonth.value)?.count || 0
    })
</script>

<template>
    <Head>
        <title>Dashboard - Conteo de Noticias México - Segob</title>
    </Head>

    <div class="px-4 py-8 mx-auto max-w-7xl">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">Dashboard - Conteo de Noticias México</h1>

        <!-- Filtros -->
        <div class="mb-8 p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">Filtros</h2>
            
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <!-- Filtro por Año -->
                <div>
                    <label for="year-filter" class="block mb-2 text-sm font-medium text-gray-700">
                        Año
                    </label>
                    <select
                        id="year-filter"
                        v-model="selectedYear"
                        @change="applyFilters"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                    >
                        <option value="">Todos los años</option>
                        <option v-for="year in availableYears" :key="year" :value="year">
                            {{ year }}
                        </option>
                    </select>
                </div>

                <!-- Filtro por Mes -->
                <div>
                    <label for="month-filter" class="block mb-2 text-sm font-medium text-gray-700">
                        Mes
                    </label>
                    <select
                        id="month-filter"
                        v-model="selectedMonth"
                        @change="applyFilters"
                        :disabled="!selectedYear"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 disabled:bg-gray-100 disabled:cursor-not-allowed"
                    >
                        <option value="">Todos los meses</option>
                        <option v-for="month in availableMonths" :key="month" :value="month">
                            {{ monthNames[month - 1] }}
                        </option>
                    </select>
                </div>

                <!-- Botón Limpiar -->
                <div class="flex items-end">
                    <button
                        @click="clearFilters"
                        class="w-full px-4 py-2 text-white bg-red-700 rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                        Limpiar Filtros
                    </button>
                </div>
            </div>
        </div>

        <!-- Tarjeta del Dashboard -->
        <div class="mb-8">
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="flex items-center justify-center">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-6 text-center">
                        <p class="text-lg font-medium text-gray-500">{{ currentFilterText }}</p>
                        <p class="text-4xl font-bold text-gray-900">{{ totalCount.toLocaleString() }}</p>
                        <p class="text-sm text-gray-500">Noticias encontradas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos de Conteo -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Conteo por Años -->
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Conteo por Años (Últimos 6 años)</h3>
                <div class="space-y-3">
                    <div v-for="item in yearlyCounts" :key="item.year" class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">{{ item.year }}</span>
                        <div class="flex items-center">
                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                <div 
                                    class="bg-blue-600 h-2 rounded-full" 
                                    :style="{ width: `${(item.count / Math.max(...yearlyCounts.map(y => y.count))) * 100}%` }"
                                ></div>
                            </div>
                            <span class="text-sm font-bold text-gray-900 w-12 text-right">{{ item.count.toLocaleString() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conteo por Meses -->
            <div v-if="selectedYear" class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Conteo por Meses - {{ selectedYear }}</h3>
                <div class="space-y-3">
                    <div v-for="item in monthlyCounts" :key="item.month" class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">{{ monthNames[item.month - 1] }}</span>
                        <div class="flex items-center">
                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                <div 
                                    class="bg-green-600 h-2 rounded-full" 
                                    :style="{ width: `${monthlyCounts.length > 0 ? (item.count / Math.max(...monthlyCounts.map(m => m.count))) * 100 : 0}%` }"
                                ></div>
                            </div>
                            <span class="text-sm font-bold text-gray-900 w-12 text-right">{{ item.count.toLocaleString() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    /* Estilos adicionales si son necesarios */
</style>
