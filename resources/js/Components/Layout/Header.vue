<script setup>
import { Link, usePage } from '@inertiajs/vue3'

const appSettings = usePage().props.app_settings
</script>

<template>
    <div class="py-8 md:flex md:justify-between md:items-center mx-auto max-w-6xl">
        <h1 class="flex flex-col text-4xl font-bold text-gold">
            <Link href="/">
            <figure>
                <img class="w-[12rem]" :src="`/storage/${appSettings.logo}`" alt="Segob Noticias" />
            </figure>
            </Link>
        </h1>
        <div class="flex items-center">
            <div class="hidden md:block pr-6">
                <div class="flex items-center justify-center gap-4">
                    <template v-for="social in appSettings.social_networks" :key="social.network">
                        <a :href="social.url" target="_blank">
                            <i
                                :class="`text-3xl text-burgundy fa-brands fa-${social.network === 'twitter' ? 'x-twitter' : social.network}`"></i>
                        </a>
                    </template>
                </div>
            </div>
            <figure class="hidden md:inline-block w-[6rem] -my-8">
                <img class="-mb-[9px]" src="/assets/grecaGuinda.png" alt="" />
            </figure>
        </div>
    </div>
</template>
