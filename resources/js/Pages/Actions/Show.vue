<script setup>
    import PostPresenter from '@/Presenters/PostPresenter'
    import { ref } from 'vue'
    import { router, Head } from '@inertiajs/vue3'

    const props = defineProps({
        action: Object,
        posts: Object,
        mainPosts: Object,
        search: String,
    })

    let mainPost = props.mainPosts.data[0]
    let secondaryPosts = props.mainPosts.data.slice(1, 3)
    let tertiaryPosts = props.mainPosts.data.slice(3)

    let search = ref(props.search)

    let searchPost = () => {
        router.get(
            route('actions.show', props.action.data.slug),
            {
                search: search.value,
            },
            {
                preserveScroll: true,
            },
        )
    }
</script>

<template>
    <Head>
        <title>{{ action.data.name }} - Segob</title>
    </Head>

    <div class="flex justify-center bg-[#F1EDE1] -mx-4 -mt-8 py-6 mb-8">
        <img :src="action.data.banner" alt="Banner" class="w-[20rem]" />
    </div>
    <div class="max-w-7xl mx-auto">
        <div
            v-if="mainPosts.data.length > 0"
            class="flex flex-col gap-10 lg:grid lg:grid-cols-2 lg:gap-10 xl:grid-cols-[1fr_2fr_1fr]"
        >
            <div class="flex gap-10 xl:order-1">
                <article>
                    <figure>
                        <img :src="mainPost.featured_image" alt="Main Post Image" class="w-full" />
                    </figure>
                    <h2 class="text-2xl font-medium xl:text-5xl">{{ mainPost.title }}</h2>
                    <div class="flex italic items-center gap-2 pt-2 text-sm">
                        <span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline-block w-3 h-3 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                            {{ new PostPresenter(mainPost).formattedDate }}
                        </span>
                        <span># {{ action.data.name }}</span>
                    </div>
                </article>
            </div>
            <div class="flex flex-col gap-10 xl:order-0">
                <article
                    class="lg:border-b lg:border-gray-200 lg:pb-2"
                    v-for="secondaryPost in secondaryPosts"
                    :key="secondaryPost.id"
                >
                    <figure>
                        <img :src="secondaryPost.featured_image" alt="Secondary Post Image" class="w-full" />
                    </figure>
                    <h2 class="text-2xl font-medium">{{ secondaryPost.title }}</h2>
                    <div class="flex italic items-center gap-2 pt-2 lg:flex-col lg:items-start text-sm">
                        <span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline-block w-3 h-3 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                            {{ new PostPresenter(secondaryPost).formattedDate }}
                        </span>
                        <span># {{ action.data.name }}</span>
                    </div>
                </article>
            </div>
            <div class="flex flex-col gap-10 lg:col-span-2 xl:col-span-1 xl:order-2 xl:gap-8">
                <article
                    class="lg:border-b lg:border-gray-200 lg:pb-2"
                    v-for="tertiaryPost in tertiaryPosts"
                    :key="tertiaryPost.id"
                >
                    <h2 class="text-2xl font-medium">{{ tertiaryPost.title }}</h2>
                    <div class="flex italic items-center gap-2 pt-2 lg:flex-col lg:items-start text-sm">
                        <span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline-block w-3 h-3 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                            {{ new PostPresenter(tertiaryPost).formattedDate }}
                        </span>
                        <span># {{ action.data.name }}</span>
                    </div>
                </article>
            </div>
        </div>
        <div v-else class="text-center py-10">
            <p class="text-gray-500 text-lg">No hay posts disponibles en esta categoría</p>
        </div>

        <div>
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm mt-8">
                <form class="max-w-3xl mx-auto flex gap-2" @submit.prevent="searchPost">
                    <input
                        type="text"
                        placeholder="Buscar..."
                        v-model="search"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-black focus:border-black"
                    />
                    <button
                        type="submit"
                        class="px-6 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition-colors"
                    >
                        Buscar
                    </button>
                </form>
            </div>
            <div v-if="posts.data.length > 0" class="lg:grid lg:grid-cols-2 lg:gap-4">
                <article v-for="post in posts.data" :key="post.id">
                    <a
                        :href="route('posts.show', post.slug)"
                        class="flex gap-4 items-start border-b border-gray-200 py-6"
                    >
                        <img :src="post.featured_image" alt="Post Image" class="w-48 h-32 object-cover rounded-md" />
                        <div>
                            <h2 class="text-2xl font-medium">{{ post.title }}</h2>
                            <div class="flex italic items-center gap-2 pt-2 text-sm">
                                <span>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="inline-block w-3 h-3 mr-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>
                                    {{ new PostPresenter(post).formattedDate }}
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
            <div v-else class="text-center py-10">
                <p class="text-gray-500 text-lg">No se encontraron resultados para tu búsqueda</p>
            </div>
        </div>
    </div>
</template>
