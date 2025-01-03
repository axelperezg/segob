<script setup>
import { Link } from '@inertiajs/vue3';
import DocumentPresenter from '@/Presenters/DocumentPresenter';

const props = defineProps({
    document: {
        type: Object,
        required: true
    }
});

const documentPresent = new DocumentPresenter(props.document);
</script>

<template>
    <Link href="/" class="hover:opacity-95">
        <article class="flex flex-col">
            <img :src="documentPresent.image" :alt="documentPresent.name" class="w-full rounded">
            <div>
                <h2 class="text-2xl font-medium mt-3">{{ documentPresent.name }}</h2>
                <div class="flex flex-col gap-2 mt-2 text-sm text-gray-600">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ documentPresent.published_at }}
                    </span>
                </div>
            </div>
        </article>
    </Link>
</template> 