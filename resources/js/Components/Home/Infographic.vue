<script setup>
import { computed } from 'vue'
import DocumentPresenter from '@/Presenters/DocumentPresenter'

const props = defineProps({
    document: {
        type: Object,
        required: true,
    },
})

const documentPresenter = computed(() => new DocumentPresenter(props.document))
</script>

<template>
    <div class="px-2">
        <img :src="documentPresenter.image" :alt="documentPresenter.name" class="w-full mb-4 rounded-lg">
        <p class="font-semibold text-xl text-left text-gray-700">{{ documentPresenter.name }}</p>
        <p class="mb-1 text-sm text-gray-600 font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3 mr-1" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ documentPresenter.published_at }}
        </p>
    </div>
</template> 