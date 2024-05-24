<template>
	<div :class="`z-50 fixed ${alert.position}`">
		<div :class="`animate__animated ${alert.isShow ? 'animate__bounceInRight' : 'animate__bounceOutRight hidden'} animate__faster flex p-4 mb-4 rounded-lg bg-white shadow-lg border border-gray-100 dark:border-gray-700 dark:bg-gray-600 dark:alert-${alert.color} alert-${alert.color}`" role="alert">
			<svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
			<span class="sr-only">Уведомление</span>
			<div class="ml-3 text-sm font-medium" v-html="alert.text"></div>
			<button @click="alert.close" type="button" :class="`ml-auto -mx-1.5 -my-1.5 text-gray-500 p-1.5 inline-flex h-8 w-8 dark:text-gray-400`">
				<span class="sr-only">Закрыть</span>
				<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
			</button>
		</div>
	</div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { useAlertStore } from "@/store/AlertStore";

export default defineComponent({
	name: "Alert",
	setup() {
		return {
			alert: useAlertStore()
		}
	}
});
</script>

<style scoped>
	:is(.dark .dark\:alert-red) {
		color: #ff6363;
	}

	.alert-red {
		color: #e91e63;
		/*background-color: red;*/
	}

	:is(.dark .dark\:alert-green) {
		color: #8bc34a;
	}

	.alert-green {
		color: #8bc34a;
		/*background-color: red;*/
	}
</style>
