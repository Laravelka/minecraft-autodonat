<template>
	<div class="relative">
		<button @click="isOpen = !isOpen" type="button" class="flex mr-3 text-sm bg-gray-700 rounded-full md:mr-0 ffocus:ring-4 ffocus:ring-gray-300 ddark:focus:ring-gray-600" data-dropdown-placement="bottom">
			<svg class="hidden h-8 w-8 dark:text-gray-200 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
			</svg>
			<img class="object-cover bg-center w-8 h-8 rounded-full" :src="`https://i.pinimg.com/736x/22/87/7c/22877cb68b6347eb3e2e2e5e8ff5a1c6--voxel-pixel-art.jpg`" alt="user photo">
		</button>
		<div :class="isOpen ? `absolute top-11 -right-3` : `hidden`" class="z-100 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
			<div class="px-4 py-3">
				<span class="block text-sm text-gray-900 dark:text-white">{{ user.name }}</span>
				<span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ user.email ?? 'Не привязан e-mail' }}</span>
			</div>
			<ul class="py-2" aria-labelledby="user-menu-button">
				<li v-if="user.email">
					<router-link @click="isOpen = false" :to="{name: 'Profile'}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Профиль</router-link>
				</li>
				<li>
					<router-link :to="{name: 'Profile'}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Настройки</router-link>
				</li>
				<li>
					<div @click="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Выйти</div>
				</li>
			</ul>
		</div>
	</div>
</template>
<script lang="ts">
import {defineComponent, ref} from "vue";
import {useUserStore} from "../store/UserStore";
import config from "../config";

export default defineComponent({
	name: "UserDropdown",
    computed: {
        config() {
            return config
        }
    },
	props: ['user'],
	setup() {
		const { logout } = useUserStore();
		const isOpen = ref(false);

		return {
			isOpen,
			logout
		}
	}
})
</script>

<style scoped>

</style>
