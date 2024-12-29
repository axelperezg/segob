<script setup>
import { usePage } from '@inertiajs/vue3'

const appSettings = usePage().props.app_settings
</script>

<template>
    <section class="py-12 -mx-4">
        <div class="container px-4 mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center">Redes Sociales</h2>
        </div>

        <div class="flex justify-center gap-4">
            <template v-for="social in appSettings.social_networks" :key="social.network">
                <a :href="social.url" target="_blank" class="px-3 py-2 border-2 rounded-lg border-burgundy">
                    <i :class="`text-3xl text-burgundy fa-brands fa-${social.network === 'twitter' ? 'x-twitter' : social.network}`"></i>
                </a>
            </template>
        </div>

        <div class="container px-4 mx-auto mt-12">
            <div class="flex flex-col md:mb-12">
                <h4 class="pb-1 text-2xl font-bold text-left text-gray-600 border-b-2 border-gray-300">
                    Contacto
                </h4>
                <span class="inline-block w-[2rem] border-b-4 border-gold relative top-[-2px]"></span>
            </div>
            <div class="space-y-8 xl:flex xl:space-y-0">
                <div v-html="appSettings.contact_content" class="xl:w-3/12 prose-p:mb-1">
                </div>
                <div class="xl:w-9/12">
                    <div v-html="appSettings.map_url"></div>
                </div>
            </div>
        </div>
    </section>
</template> 