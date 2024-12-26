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
            const response = await axios.get('/api/content-types');
            contentTypes.value = response.data;
        } catch (e) {
            error.value = 'Error loading content types';
            console.error('Error loading content types:', e);
        } finally {
            loading.value = false;
        }
    };

    onMounted(() => {
        fetchContentTypes();
    });

    return {
        contentTypes,
        loading,
        error,
        fetchContentTypes
    };
} 