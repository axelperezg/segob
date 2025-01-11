<script setup>
import TopBar from '@/Components/Layout/TopBar.vue'
import Header from '@/Components/Layout/Header.vue'
import MainMenu from '@/Components/Layout/MainMenu.vue'
import Footer from '@/Components/Layout/Footer.vue'
</script>

<template>
    <main class="px-4 pt-8 mx-auto">
        <TopBar />
        <Header />
        <MainMenu />
        <div class="pt-8">
            <slot />
        </div>
    </main>
    <div class="pt-12"></div>
    <Footer />
</template>
