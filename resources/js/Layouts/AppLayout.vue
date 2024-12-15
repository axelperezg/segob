<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const mainMenu = usePage().props.main_menu
const isMenuOpen = ref(false)

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value
}
</script>

<template>
    <main class="px-4 pt-8 mx-auto">
        <div class="border-b border-burgundy bg-burgundy -mx-4">
            <div class="flex items-center justify-between px-6 py-2 -mt-8 max-w-7xl mx-auto">
                <div class="flex items-center">
                    <img class="w-[9rem]" src="/assets/esados-unidos-mexicanos.svg" alt="Logo Gobierno de México" />
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
                <Link href="/">
                    <figure>
                        <img class="w-[12rem]" src="/assets/segob-noticias.png" alt="Segob Noticias" />
                    </figure>
                </Link>
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
                    <img class="-mb-[9px]" src="/assets/pleca.jpg" alt="" />
                </figure>
            </div>
        </div>

        <!-- Menu -->
        <nav class="-mx-4 border-burgundy md:bg-gold md:border-t-[.6rem] md:border-burgundy">
            <div class="px-4 mx-auto max-w-7xl">
                <div class="flex flex-wrap items-center justify-between">
                    <ul
                        class="flex flex-col flex-wrap w-full md:gap-x-4 md:flex-row md:space-y-0"
                        :class="{ 'hidden md:flex': !isMenuOpen, block: isMenuOpen }"
                    >
                        <li v-for="item in mainMenu" :key="item.name" class="relative py-2 md:py-4">
                            <Link
                                @click.prevent="item.isOpen = !item.isOpen"
                                :href="item.url"
                                class="flex items-center gap-2 font-medium transition-colors md:text-white"
                            >
                                {{ item.name }}
                                <svg
                                    v-if="item.submenu"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 ml-1 transition-transform"
                                    :class="{ 'rotate-180': item.isOpen }"
                                    viewBox="0 0 512 512"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M239 401c9.4 9.4 24.6 9.4 33.9 0L465 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-175 175L81 175c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9L239 401z"
                                    />
                                </svg>
                            </Link>
                            <ul
                                v-if="item.submenu"
                                class="left-0 mt-2 py-2 md:w-[20rem] bg-white border border-gray-200 rounded shadow-lg md:absolute"
                                :class="{ hidden: !item.isOpen, block: item.isOpen }"
                                @mouseleave="item.isOpen = false"
                            >
                                <li v-for="subitem in item.submenu" :key="subitem.name">
                                    <Link
                                        :href="subitem.url"
                                        class="block px-4 py-2 text-md text-gray-700 hover:bg-gray-100"
                                    >
                                        {{ subitem.name }}
                                    </Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <button @click="toggleMenu" class="w-full px-4 py-2 text-white rounded md:hidden bg-burgundy">
                        Menú
                    </button>
                </div>
            </div>
        </nav>
        <div class="pt-8">
            <slot />
        </div>
    </main>
    <!-- Footer -->
    <div class="pt-12"></div>
    <footer class="py-12 bg-burgundy">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4">
                <div>
                    <img src="/assets/logoheader.svg" alt="Gobierno de México" class="w-[12rem]" />
                </div>
                <div>
                    <h4 class="mb-4 font-bold text-white">Enlaces</h4>
                    <ul class="space-y-2 text-sm text-white">
                        <li><a href="#" class="hover:underline">Datos</a></li>
                        <li><a href="#" class="hover:underline">Publicaciones</a></li>
                        <li><a href="#" class="hover:underline">Política de transparencia</a></li>
                        <li><a href="#" class="hover:underline">PNT</a></li>
                        <li><a href="#" class="hover:underline">INAI</a></li>
                        <li><a href="#" class="hover:underline">Alerta</a></li>
                        <li><a href="#" class="hover:underline">Denuncia</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 font-bold text-white">¿Qué es gob.mx?</h4>
                    <ul class="space-y-2 text-sm text-white">
                        <li>
                            <a href="#" class="hover:underline"
                                >Es el portal único de trámites, información y participación ciudadana</a
                            >
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Declaración de accesibilidad</a>
                        </li>
                        <li><a href="#" class="hover:underline">Aviso de privacidad</a></li>
                        <li><a href="#" class="hover:underline">Términos y condiciones</a></li>
                        <li><a href="#" class="hover:underline">Política de seguridad</a></li>
                        <li><a href="#" class="hover:underline">Marco jurídico</a></li>
                        <li><a href="#" class="hover:underline">Mapa de sitio</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 font-bold text-white">Contacto</h4>
                    <p class="text-white">Dudas e información a</p>
                    <p class="text-white break-words">
                        www.gob.mx/tramites/ficha/presentacion-de-quejas-y-denuncias-en-la-sfp/SFP54
                    </p>
                    <h4 class="mt-4 mb-2 text-sm font-bold text-white">Síguenos en</h4>
                    <div class="flex gap-2">
                        <a href="#" class="text-lg text-white hover:text-gray-300"
                            ><i class="fa-brands fa-facebook-f"></i
                        ></a>
                        <a href="#" class="text-lg text-white hover:text-gray-300"
                            ><i class="fa-brands fa-x-twitter"></i
                        ></a>
                        <a href="#" class="text-lg text-white hover:text-gray-300"
                            ><i class="fa-brands fa-instagram"></i
                        ></a>
                        <a href="#" class="text-lg text-white hover:text-gray-300"
                            ><i class="fa-brands fa-youtube"></i
                        ></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
