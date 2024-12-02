<script setup>
</script>

<template>
    <main class="px-4 pt-8 mx-auto">
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
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">INICIO</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">NOTICIAS</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">VERSIONES</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">DOCUMENTOS</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">SEGOB</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">GALERÍAS</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">VIDEO</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">NOTICIAS
                                MÉXICO</a>
                        </li>
                        <li class="py-2 md:py-4">
                            <a href="#"
                                class="font-medium transition-colors md:text-white hover:text-gold-soft">ACCIONES</a>
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
    <footer class="py-12 -mx-4 bg-burgundy">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4">
                <div>
                    <img src="/assets/logoheader.svg" alt="Gobierno de México" class="w-[12rem]">
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
                        <li><a href="#" class="hover:underline">Es el portal único de trámites, información y
                                participación ciudadana</a></li>
                        <li><a href="#" class="hover:underline">Declaración de accesibilidad</a></li>
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
                        www.gob.mx/tramites/ficha/presentacion-de-quejas-y-denuncias-en-la-sfp/SFP54</p>
                    <h4 class="mt-4 mb-2 text-sm font-bold text-white">Síguenos en</h4>
                    <div class="flex gap-2">
                        <a href="#" class="text-lg text-white hover:text-gray-300"><i
                                class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-lg text-white hover:text-gray-300"><i
                                class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" class="text-lg text-white hover:text-gray-300"><i
                                class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-lg text-white hover:text-gray-300"><i
                                class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
