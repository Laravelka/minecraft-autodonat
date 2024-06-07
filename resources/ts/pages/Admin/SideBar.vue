<template>
    <div class="min-h-screen flex flex-col bg-gray-800 text-white w-64">
        <div class="flex items-center justify-center h-16 shadow-md">
            <h1 class="text-2xl font-bold">Admin Panel</h1>
        </div>
        <nav class="flex-1 px-2 py-4">
            <router-link
                v-for="link in links"
                :key="link.id"
                :to="link.url"
                class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-700 rounded-lg hover:bg-gray-600"
            >
                {{ link.title }}
            </router-link>
        </nav>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Sidebar',
    setup() {
        const links = [
            {
                id: 1,
                title: 'История покупок',
                url: '/admin/purchaseHistory',
                icon: '/icons/analytics.png',
            },
            {
                id: 2,
                title: 'Пользователи',
                url: '/admin/users',
                icon: '/icons/user.png',
            },
            {
                id: 3,
                title: 'Категории',
                url: '/admin/categories',
                icon: '/icons/category.png',
            },
            {
                id: 4,
                title: 'Продукты',
                url: '/admin/products',
                icon: '/icons/product.png',
            },
            {
                id: 5,
                title: 'Сервера',
                url: '/admin/servers',
                icon: '/icons/server.png',
            },
            {
                id: 6,
                title: 'Промокоды',
                url: '/admin/promocodes',
                icon: '/icons/promocode.png',
            },
            {
                id: 7,
                title: 'Настройки',
                url: '/admin/settings',
                icon: '/icons/settings.png',
            },
            // Добавьте больше ссылок на страницы админки здесь
        ];

        return {
            links,
        };
    },
});
</script>

<style scoped>
/* Добавьте свои стили здесь */
</style>
