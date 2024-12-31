import { ref } from 'vue'
import axios from 'axios'

export function useDependencies() {
    const dependencies = ref([])

    const fetchDependencies = async () => {
        try {
            const response = await axios.get('/api/dependencies')
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
