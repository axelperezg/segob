<script setup>
    defineProps({
        links: {
            type: Array,
            required: true,
        },
    })

    const emit = defineEmits(['pageChanged'])

    const handleClick = (url) => {
        if (url) {
            emit('pageChanged', url)
        }
    }
</script>

<template>
    <div class="flex items-center justify-center gap-2">
        <template v-for="link in links" :key="link.label">
            <div
                v-if="link.url"
                @click="handleClick(link.url)"
                :class="[
                    'px-4 py-2 rounded-md cursor-pointer transition-colors',
                    link.active ? 'bg-burgundy text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-700',
                    // Hide numbered pages on mobile, only show Previous/Next
                    !['Anterior', 'Siguiente'].includes(link.label) ? 'hidden sm:block' : '',
                ]"
                v-html="link.label"
            />
            <div
                v-else
                :class="[
                    'px-4 py-2 text-gray-400 cursor-not-allowed',
                    // Hide numbered pages on mobile, only show Previous/Next
                    !['Anterior', 'Siguiente'].includes(link.label) ? 'hidden sm:block' : '',
                ]"
                v-html="link.label"
            />
        </template>
    </div>
</template>
