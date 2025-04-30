<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section class="-mx-4 bg-gold md:py-6">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center md:flex-row md:max-w-5xl mx-auto">
                <Link as="h2" :href="route('mexico-news.index')"
                    class="flex flex-col items-center space-y-2 md:flex-row md:space-y-0">
                <figure class="md:pr-12">
                    <img src="/assets/noticias-mx.svg" alt="Noticias MX" class="w-32 md:w-24">
                </figure>
                <div>
                    <p class="font-medium text-white text-md">Noticias Mexico</p>
                    <p class="font-medium text-white text-md">Comunicados generados por el Gobierno de México</p>
                </div>
                </Link>
            </div>
        </div>
    </section>
</template>

<style scoped></style>