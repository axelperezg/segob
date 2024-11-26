<script setup>
    defineProps({
        mainPosts: Array,
        secondaryPosts: Array,
        tertiaryPosts: Array
    });
</script>

<template>
    <main class="px-4 pt-8 mx-auto font-montserrat">
        <div class="border-b border-burgundy bg-burgundy -mx-4">
            <div class="flex items-center justify-between px-6 py-2 -mt-8 max-w-7xl mx-auto">
                <div class="flex items-center">
                    <img class="w-[9rem]" src="/assets/esados-unidos-mexicanos.svg" alt="Logo Gobierno de México">
                </div>
                <div class="flex items-center space-x-4 text-white">
                    <a href="#" class="text-sm hover:text-gold">Noticias</a>
                    <a href="#" class="text-sm hover:text-gold">Gobierno</a>
                    <a href="#" class="text-sm hover:text-gold">Español</a>
                </div>
            </div>
        </div>
        <div class="py-8 md:flex md:justify-between md:items-center mx-auto max-w-6xl">
            <h1 class="flex flex-col text-4xl font-bold text-gold">
                <figure>
                    <img class="w-[12rem]" src="/assets/segob-noticias.png" alt="Segob Noticias">
                </figure>
            </h1>
            <div class="flex items-center">
                <div class="hidden md:block pr-6">
                    <div class="flex items-center justify-center gap-4">
                        <i class="text-3xl text-burgundy fa-brands fa-facebook-f"></i>
                        <i class="text-3xl text-burgundy fa-brands fa-x-twitter"></i>
                        <i class="text-3xl text-burgundy fa-brands fa-instagram"></i>
                        <i class="text-3xl text-burgundy fa-brands fa-youtube"></i>
                        <i class="text-3xl text-burgundy fa-brands fa-tiktok"></i>
                    </div>
                </div>
                <figure class="hidden md:inline-block w-[6rem] -my-8">
                    <img class="-mb-[9px]" src="/assets/pleca.jpg" alt="">
                </figure>
            </div>
        </div>

        <!-- Menu -->
        <nav class="-mx-4 border-burgundy md:bg-gold md:border-t-[.6rem] md:border-burgundy">
            <div class="px-4 mx-auto max-w-7xl">
                <div class="flex flex-wrap items-center justify-between">
                    <ul class="flex flex-col flex-wrap w-full md:gap-x-4 md:flex-row md:space-y-0"
                        :class="{ 'hidden md:flex': !isMenuOpen, 'block': isMenuOpen }">
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">INICIO</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">NOTICIAS</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">VERSIONES</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">DOCUMENTOS</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">SEGOB</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">GALERÍAS</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">VIDEO</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">NOTICIAS MÉXICO</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#" class="font-medium transition-colors md:text-white hover:text-gold-soft">ACCIONES</a>
                        </li>
                    </ul>
                    <button @click="toggleMenu" class="w-full px-4 py-2 text-white rounded md:hidden bg-burgundy">
                        Menú
                    </button>
                </div>
            </div>
        </nav>

           <!-- Posts -->
           <section class="py-8 max-w-7xl mx-auto">
                <h3 class="text-2xl font-bold lg:text-3xl">Noticias</h3>
                <div class="grid grid-cols-1 gap-6 pb-8 pt-4 lg:flex">
                    <div class="space-y-6 lg:w-2/3">
                        <!-- Main posts -->
                        <article v-for="post in mainPosts" :key="post.id" class="overflow-hidden border rounded-lg">
                            <img :src="post.image" :alt="post.title" class="w-full">
                            <div class="p-4">
                                <h2 class="mb-2 text-xl font-bold lg:text-4xl">{{ post.title }}</h2>
                                <p class="mb-1 text-xs italic text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3 mr-1"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ new Date(post.published_at).toLocaleDateString('es-MX', { day: '2-digit', month: '2-digit', year: 'numeric' }) }}
                                </p>
                                <div v-html="post.content"></div>
                            </div>
                        </article>
                    </div>
                    <!-- Secondary posts -->
                    <div class="space-y-6 lg:w-1/3">
                        <article v-for="post in secondaryPosts" :key="post.id"
                            class="overflow-hidden border rounded-lg">
                            <img :src="post.image" :alt="post.title" class="w-full">
                            <div class="p-4">
                                <h2 class="mb-2 text-lg font-bold leading-tight">{{ post.title }}</h2>
                                <p class="mb-1 text-xs italic text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3 mr-1"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ new Date(post.published_at).toLocaleDateString('es-MX', { day: '2-digit', month: '2-digit', year: 'numeric' }) }}
                                </p>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="space-y-6 md:grid md:grid-cols-2 md:gap-6 md:space-y-0 lg:grid-cols-3">
                    <article v-for="post in tertiaryPosts" :key="post.id" class="overflow-hidden border rounded-lg">
                        <img :src="post.image" :alt="post.title" class="w-full">
                        <div class="p-4">
                            <h2 class="mb-2 text-lg font-bold">{{ post.title }}</h2>
                            <p class="mb-1 text-xs italic text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ new Date(post.published_at).toLocaleDateString('es-MX', { day: '2-digit', month: '2-digit', year: 'numeric' }) }}
                            </p>
                        </div>
                    </article>
                </div>

                <div class="flex justify-center mt-8">
                    <button
                        class="px-8 py-2 font-medium text-white transition-colors rounded bg-burgundy hover:bg-gold">
                        Ver más
                    </button>
                </div>
            </section>
    </main>
</template>
