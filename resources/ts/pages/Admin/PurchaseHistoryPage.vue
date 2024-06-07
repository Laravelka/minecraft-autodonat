<template>
    <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-neutral-900">

        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Ник игрока
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Когда оплачено
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Сумма
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    <template v-for="(purchase, index) in purchaseHistory" :key="purchase.id">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ purchase.id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ purchase.player_nickname }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ new Date(purchase.invoice_paid_at).toLocaleString() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ purchase.invoice_price.toFixed(2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button @click="toggleDetails(index)" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-500">
                                                    {{ expandedRows.includes(index) ? 'Скрыть' : 'Открыть' }} подробности
                                                </button>
                                            </td>
                                        </tr>
                                        <tr v-if="expandedRows.includes(index)" class="bg-gray-50 dark:bg-gray-700">
                                            <td colspan="5" class="px-6 py-4">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    <strong>E-mail:</strong> {{ purchase.player_email }}
                                                </div>
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    <strong>Команда:</strong> {{ purchase.issue_command }}
                                                </div>
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    <strong>Ответ:</strong> {{ purchase.server_response || 'N/A' }}
                                                </div>
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    <strong>Игрок:</strong> {{ purchase.user_id || 'N/A' }}
                                                </div>
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    <strong>Товар:</strong> {{ purchase.product_id }}
                                                </div>
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    <strong>Промокод:</strong> {{ purchase.promocode_id || 'N/A' }}
                                                </div>
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    <strong>Сервер:</strong> {{ purchase.server_id }}
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
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
import { defineComponent, ref } from 'vue';
import { PurchaseHistory } from '../models/PurchaseHistory';

export default defineComponent({
    name: 'PurchaseHistoryTable',
    setup() {
        const purchaseHistory = ref<PurchaseHistory[]>([
            {
                id: 1,
                player_nickname: 'Player1',
                invoice_paid_at: '2024-06-07T10:00:00Z',
                player_email: 'player1@example.com',
                invoice_price: 49.99,
                issue_command: 'give player1 diamond_sword',
                server_response: 'Command executed successfully',
                user_id: 1,
                product_id: 1,
                promocode_id: 1,
                server_id: 1,
                created_at: '',
                updated_at: ''
            },
            {
                id: 2,
                player_nickname: 'Player2',
                invoice_paid_at: '2024-06-08T12:00:00Z',
                player_email: 'player2@example.com',
                invoice_price: 29.99,
                issue_command: 'give player2 iron_sword',
                server_response: null,
                user_id: null,
                product_id: 2,
                promocode_id: null,
                server_id: 2,
                created_at: '',
                updated_at: ''
            },
            // Добавьте больше записей истории покупок здесь
        ]);

        const expandedRows = ref<number[]>([]);

        const toggleDetails = (index: number) => {
            const rowIndex = expandedRows.value.indexOf(index);
            if (rowIndex > -1) {
                expandedRows.value.splice(rowIndex, 1);
            } else {
                expandedRows.value.push(index);
            }
        };

        return {
            purchaseHistory,
            expandedRows,
            toggleDetails,
        };
    },
});
</script>

<style scoped>
/* Добавьте свои стили здесь */
</style>
