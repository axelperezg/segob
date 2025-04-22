import { ref, onMounted } from 'vue';
import axios from 'axios';

export function useContentTypes() {
    const contentTypes = ref([]);
    const loading = ref(false);
    const error = ref(null);

    const fetchContentTypes = async () => {
        loading.value = true;
        error.value = null;
        
        try {
            // Verificar si estamos en un entorno de servidor (SSR)
            const baseUrl = typeof window === 'undefined' 
                ? process.env.APP_URL || 'http://localhost' 
                : '';
                
            const response = await axios.get(`${baseUrl}/api/content-types`);
            contentTypes.value = response.data;
        } catch (e) {
            error.value = 'Error loading content types';
            console.error('Error loading content types:', e);
        } finally {
            loading.value = false;
        }
    };

    // Si estamos en SSR, ejecutamos inmediatamente
    // Si estamos en el cliente, esperamos a mounted
    if (typeof window === 'undefined') {
        fetchContentTypes();
    } else {
        onMounted(() => {
            fetchContentTypes();
        });
    }

    return {
        contentTypes,
        loading,
        error,
        fetchContentTypes
    };
} 