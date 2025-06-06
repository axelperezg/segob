<script setup>
    import { usePage } from '@inertiajs/vue3'

    const appSettings = usePage().props.app_settings
</script>

<template>
    <div class="z-10 -mx-4 border-b lg:top-0 lg:sticky border-burgundy bg-burgundy">
        <div class="flex items-center justify-between px-6 py-2 mx-auto -mt-8 max-w-7xl">
            <div class="flex items-center">
                <img class="w-[9rem]" :src="`/storage/${appSettings.mexico_logo}`" alt="Logo Gobierno de México" />
            </div>
            <div class="flex items-center space-x-4 text-white">
                <a
                    v-for="link in appSettings.top_bar_links"
                    :href="link.url"
                    :target="link.external == 1 ? '_blank' : '_self'"
                    class="text-sm hover:text-gold"
                >
                    {{ link.name }}
                </a>
            </div>
        </div>
    </div>
</template>
