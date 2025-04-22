import { ref } from 'vue'
import axios from 'axios'

export function useDependencies() {
    const dependencies = ref([])

    const fetchDependencies = async () => {
        try {
            // Verificar si estamos en un entorno de servidor (SSR)
            const baseUrl = typeof window === 'undefined' 
                ? process.env.APP_URL || 'http://localhost' 
                : '';
                
            const response = await axios.get(`${baseUrl}/api/dependencies`)
            dependencies.value = response.data
        } catch (error) {
            console.error('Error fetching dependencies:', error)
        }
    }

    fetchDependencies()

    return {
        dependencies,
    }
}
