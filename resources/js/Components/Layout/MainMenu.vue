<script setup>
    import { Link, usePage, router } from '@inertiajs/vue3'
    import { ref, onMounted, onUnmounted } from 'vue'

    const mainMenu = usePage().props.main_menu
    const isMenuOpen = ref(false)

    const toggleMenu = () => {
        isMenuOpen.value = !isMenuOpen.value
    }

    const closeAllSubmenus = () => {
        mainMenu.forEach((item) => {
            if (item.isOpen) {
                item.isOpen = false
            }
        })
    }

    onMounted(() => {
        router.on('navigate', closeAllSubmenus)
    })

    onUnmounted(() => {
        router.off('navigate', closeAllSubmenus)
    })
</script>

<template>
    <nav class="-mx-4 border-burgundy md:bg-gold md:border-t-[.6rem] md:border-burgundy lg:sticky lg:top-[55px] z-10">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex flex-wrap items-center justify-between">
                <ul
                    class="flex flex-col flex-wrap w-full md:gap-x-4 md:flex-row md:space-y-0"
                    :class="{ 'hidden md:flex': !isMenuOpen, block: isMenuOpen }"
                >
                    <li
                        v-for="item in mainMenu"
                        :key="item.name"
                        class="relative py-2 md:py-4 text-[.8rem] lg:text-base"
                        @mouseenter="item.isOpen = true"
                        @mouseleave="item.isOpen = false"
                    >
                        <Link
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
                        >
                            <li v-for="subitem in item.submenu" :key="subitem.name">
                                <Link
                                    :href="subitem.url"
                                    class="block px-4 py-2 text-gray-700 text-md hover:bg-gray-100"
                                    @click="closeAllSubmenus"
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
</template>
