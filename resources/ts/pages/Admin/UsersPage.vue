<template>
    <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-neutral-900">
        <!-- Main Content -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <!-- Filters -->
                <div class="mb-4">
                    <input v-model="searchQuery" type="text" placeholder="Search..." class="px-4 py-2 border rounded-md w-full dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700">
                </div>

                <!-- Users Table -->
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Имя
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            E-mail
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Telegram
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            VK
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Discord
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="user in filteredUsers" :key="user.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ user.id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ user.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ user.email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ user.telegram_username }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ user.vk_username }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ user.discord_username }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-500">Edit</a>
                                            <a href="#" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-500 ml-4">Delete</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed } from 'vue';
import { User } from '../../models/User';

export default defineComponent({
    name: 'UsersTable',
    setup() {
        const searchQuery = ref('');
        const isDarkMode = ref(false);
        const users = ref<User[]>([
            { id: 1, name: 'John Doe', email: 'johndoe@example.com', telegram_username: '@johndoe', vk_username: '@johndoe_vk', discord_username: '@johndoe_discord' },
            // Добавьте больше пользователей здесь
        ]);

        const filteredUsers = computed(() => {
            return users.value.filter(user =>
                user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                user.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                (user.telegram_username && user.telegram_username.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
                (user.vk_username && user.vk_username.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
                (user.discord_username && user.discord_username.toLowerCase().includes(searchQuery.value.toLowerCase()))
            );
        });

        return {
            searchQuery,
            isDarkMode,
            filteredUsers,
        };
    },
});
</script>

<style scoped>
/* Добавьте свои стили здесь */
</style>
