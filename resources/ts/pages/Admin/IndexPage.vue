<template>
    <div class="min-h-screen bg-gray-100 dark:bg-neutral-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-8">Админ-панель</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="link in links" :key="link.id" class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img :src="link.icon" alt="" class="h-12 w-12">
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ link.title }}</h3>
                        <router-link :to="link.url" class="text-blue-600 dark:text-blue-400 hover:underline">{{ link.url }}</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'AdminIndexPage',
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
