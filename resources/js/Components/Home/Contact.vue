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
            <div class="space-y-8 lg:flex">
                <div class="lg:w-3/12">
                    <p class="mt-4 text-gray-600">Abraham González 48 Col.</p>
                    <p class="text-gray-600">Juárez 06600 Ciudad de México</p>
                    <p class="text-gray-600">Teléfono: 5552098800</p>
                    <p class="text-gray-600">Atención Ciudadana:</p>
                    <p class="text-gray-600">Secretaría de Gobernación.</p>
                    <p class="mt-4 font-bold text-gray-600">¿De qué se trata tu petición?</p>
                    <p class="text-gray-600">Envía tus dudas o comentarios a</p>
                    <p class="text-gray-600">atencionciudadana@segob.gob.mx</p>
                </div>
                <div class="lg:w-9/12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15050.271987476912!2d-99.1523161!3d19.4310629!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff349aad0195%3A0x7866e51535dc348!2sSecretaria%20de%20Gobernaci%C3%B3n!5e0!3m2!1ses-419!2sec!4v1731261284015!5m2!1ses-419!2sec"
                        width="100%" height="450" style="border:0;" :allowfullscreen="true" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
</template> 