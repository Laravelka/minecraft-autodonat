<script lang="ts">
import {defineComponent, ref} from 'vue'
import axios from "axios";
import {parseJsonToHtml} from "../helpers";

import ProductItem from "../components/ProductItem.vue";
import ServerListItem from "../components/ServerListItem.vue";
import RecentPurchases from "../components/RecentPurchases.vue";

export default defineComponent({
    name: "HomePage.vue",
    components: {ProductItem, ServerListItem, RecentPurchases},
    setup() {
        const servers = ref([]);
        const categories = ref([]);
        const onlinePlayers = ref(0);
        const activeCategory = ref<any>(null);
        const isLoading = ref(true);

        const setActiveCategory = category => activeCategory.value = category;
        const getServers = () => {
            axios.get('/api/servers').then(async ({ data }) => {
                data.forEach((server) => {
                    if (typeof server !== 'string') {
                        servers.value.push({
                            name: server.name,
                            host: server.host,
                            port: server.port,
                            version: server.version,
                            favicon: server.favicon,
                            players: server.players,
                            description: parseJsonToHtml(server.description)
                        });
                        onlinePlayers.value += server.players.online;
                    }
                });
            }).catch((error) => {
                console.log(error);
            });
        };

        const getCategoriesWithProducts = () => {
            categories.value = [];
            isLoading.value = true;
            axios.get('/api/categories/withProducts').then(({ data }) => {
                categories.value = data;
                setActiveCategory(data[0]);
                isLoading.value = false;
            }).catch((error) => {
                console.log(error);
                isLoading.value = false;
            });
        };

        getCategoriesWithProducts();
        getServers();

        return {
            servers,
            isLoading,
            categories,
            onlinePlayers,
            activeCategory,
            setActiveCategory,
            getCategoriesWithProducts,
        }
    }
})
</script>

<template>
    <!-- Hero -->
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Grid -->
        <div class="grid lg:grid-cols-7 lg:gap-x-8 xl:gap-x-12 lg:items-center">
            <div class="lg:col-span-3">
                <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl md:text-5xl lg:text-6xl dark:text-white">
                    Какой-то текст</h1>
                <p class="mt-3 text-lg text-gray-800 dark:text-neutral-400">Еще какой-то текст.</p>

                <div class="mt-5 lg:mt-8 flex flex-col items-center gap-2 sm:flex-row sm:gap-3">
                    <a class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-400 text-white hover:bg-red-500 disabled:opacity-50 disabled:pointer-events-none"
                       href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="flex-shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                        </svg>

                        Наш магазин
                    </a>
                    <a class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                       href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="flex-shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z"/>
                        </svg>
                        Начать играть
                    </a>
                </div>

                <!-- Players Online -->
                <div class="mt-6 lg:mt-12">
                    <span class="text-xs font-medium text-gray-800 uppercase dark:text-neutral-200 mr-1">Игроков онлайн:</span>
                    <div v-if="onlinePlayers == 0" class="align-middle animate-spin inline-block size-4 border-[2px] border-current border-t-transparent text-blue-500 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <b v-else class="text-sky-400">{{ onlinePlayers }}</b>
                </div>
                <!-- Players Online -->
            </div>
            <!-- End Col -->

            <div class="lg:col-span-4 mt-10 lg:mt-0">
                <img class="w-full rounded-xl" src="https://zabavnikplus.ru/wp-content/uploads/a/5/a/a5a1762dca7c2a3494781e46bfb8b7e7.png"
                     alt="Image Description">
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Hero -->

    <!-- Card Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 mb-5">
            <div v-if="categories.length == 0" class="flex animate-pulse">
                <div class="flex-shrink-0 me-2">
                    <span class="inline-block px-4 py-3 bg-gray-200 rounded-lg dark:bg-neutral-700/70 text-transparent">Загрузка</span>
                </div>
                <div class="flex-shrink-0 me-2">
                    <span class="inline-block px-4 py-3 bg-gray-200 rounded-lg dark:bg-neutral-700/70 text-transparent">Загрузка</span>
                </div>
                <div class="flex-shrink-0 me-2">
                    <span class="inline-block px-4 py-3 bg-gray-200 rounded-lg dark:bg-neutral-700/70 text-transparent">Загрузка</span>
                </div>
                <div class="flex-shrink-0 me-2">
                    <span class="inline-block px-4 py-3 bg-gray-200 rounded-lg dark:bg-neutral-700/70 text-transparent">Загрузка</span>
                </div>
            </div>
            <li v-else class="me-2" v-for="(category, i) in categories" v-bind:key="i">
                <a :href="`#${category.name}`" @click="setActiveCategory(category)" :class="{'bg-sky-600 active': activeCategory?.id == category.id, 'hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white': activeCategory?.id !== category.id}" class="inline-block px-4 py-3 text-white rounded-lg ">{{ category.name }}</a>
            </li>
        </ul>

        <div v-if="isLoading" class="flex justify-center items-center h-36">
            <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Grid -->
        <div v-else class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-1 sm:gap-5">
            <div v-if="activeCategory?.products?.length == 0" class="col-span-3 text-gray-400 px-1">Пока что пусто...</div>
            <!-- Products -->
            <product-item v-for="(product, i) in activeCategory?.products" v-bind:key="i" :product="product"></product-item>
            <!-- End Products -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Card Section -->

    <!-- Servers Section  -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto hidden">
        <!-- Grid -->
        <div class="grid lg:grid-cols-2 lg:gap-y-16 gap-10">
            <server-list-item v-for="server in servers" :server="server" />
        </div>
    </div>

    <!-- End Servers Section  -->
    <RecentPurchases></RecentPurchases>
    <div class="max-w-[85rem] px-4 py-6 sm:px-6 lg:px-8 lg:py-14">
        <h1 class="text-white text-2xl">Последние покупки</h1>
    </div>
</template>

<style scoped>

</style>
