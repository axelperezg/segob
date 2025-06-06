<script setup>
    import { usePage } from '@inertiajs/vue3'

    const appSettings = usePage().props.app_settings
</script>

<template>
    <footer class="py-12 bg-burgundy">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4">
                <div>
                    <img :src="`/storage/${appSettings.mexico_logo}`" alt="Gobierno de México" class="w-[12rem]" />
                </div>
                <div v-for="link in appSettings.footer_links">
                    <h4 class="mb-4 font-bold text-white">{{ link.title }}</h4>
                    <ul class="space-y-2 text-sm text-white">
                        <li v-for="item in link.links">
                            <a :href="item.url" class="hover:underline">{{ item.title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>
