<script setup>
    defineProps({
        item: {
            type: Object,
            required: true,
        },
    })
</script>

<template>
    <div class="px-2">
        <img :src="item.image" :alt="item.title" class="w-full mb-4 rounded-lg" />
        <p class="mb-1 text-xs italic text-gray-600">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="inline-block w-3 h-3 mr-1"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                />
            </svg>
            {{ item.published_at }}
        </p>
        <p class="font-semibold text-left text-gray-700">{{ item.title ?? item.name }}</p>
    </div>
</template>
