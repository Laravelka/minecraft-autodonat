<script>
import {defineComponent, ref} from 'vue'
import {useUserStore} from "@/store/UserStore.ts";
import {storeToRefs} from "pinia";
import UserDropdown from "@/components/UserDropdown.vue";

export default defineComponent({
    name: "Navbar",
    components: {UserDropdown},
    setup() {
        const userStore = useUserStore();
        const {isAuth, user} = storeToRefs(userStore);
        const isOpenMenu = ref(false);

        return {
            user,
            isAuth,
            isOpenMenu
        }
    }
})
</script>

<template>
    <!-- ========== HEADER ========== -->
    <header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full py-7">
        <nav class="relative max-w-7xl w-full flex flex-wrap md:grid md:grid-cols-12 basis-full items-center px-4 md:px-6 md:px-8 mx-auto" aria-label="Global">
            <div class="md:col-span-3">
                <!-- Logo -->
                <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-none focus:opacity-80" href="/" aria-label="Preline">
                    <img class="w-16 h-16" src="https://mine.test/logo.png" alt="">
                </a>
                <!-- End Logo -->
            </div>

            <!-- Button Group -->
            <div class="flex items-center gap-x-2 ms-auto py-1 md:ps-6 md:order-3 md:col-span-3">
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-transparent bg-lime-400 text-black hover:bg-lime-500 transition disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-lime-500">
                    Играть
                </button>
                <user-dropdown v-if="isAuth" :user="user"></user-dropdown>
                <button v-else @click="$router.push({name: 'Login'})" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 text-black hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:hover:bg-white/10 dark:text-white dark:hover:text-white">
                    Войти
                </button>
                <div class="md:hidden">
                    <button @click="isOpenMenu = !isOpenMenu" type="button" class="hs-collapse-toggle size-[38px] flex justify-center items-center text-sm font-semibold rounded-xl border border-gray-200 text-black hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            </div>
            <!-- End Button Group -->

            <!-- Collapse -->
            <div id="navbar-collapse-with-animation" :class="{hidden: !isOpenMenu}" class="hs-collapse overflow-hidden transition-all duration-300 basis-full grow md:block md:w-auto md:basis-auto md:order-2 md:col-span-6">
                <div class="flex flex-col gap-y-4 gap-x-0 mt-5 md:flex-row md:justify-center md:items-center md:gap-y-0 md:gap-x-7 md:mt-0">
                    <div>
                        <a class="relative inline-block text-black before:absolute abefore:bottom-0.5 abefore:start-0 abefore:-z-[1] abefore:w-full abefore:h-1 abefore:bg-lime-400 dark:text-white" href="/" aria-current="page">Главная</a>
                    </div>
                    <div>
                        <a class="inline-block text-black hover:text-gray-600 dark:text-white dark:hover:text-neutral-300" href="/servers">Сервера</a>
                    </div>
                    <div>
                        <a class="inline-block text-black hover:text-gray-600 dark:text-white dark:hover:text-neutral-300" href="/rules">
                            Правила
                        </a>
                    </div>
                    <div>
                        <a class="inline-block text-black hover:text-gray-600 dark:text-white dark:hover:text-neutral-300" href="/products">Товары</a>
                    </div>
                    <div>
                        <a class="inline-block text-black hover:text-gray-600 dark:text-white dark:hover:text-neutral-300" href="#">Еще какая-то ссылка</a>
                    </div>
                </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->
</template>

<style scoped>

</style>
