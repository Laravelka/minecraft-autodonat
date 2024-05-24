import { defineStore } from 'pinia'

export const useAlertStore = defineStore({
	id: 'alert',
	state: () => ({
		text: null,
		color: 'green',
		isShow: false,
		position: 'top-24 right-2',
	}),
	actions: {
		show(text, color = 'green', closeTime = 2500) {
			this.text = text;
			this.color = color;
			this.isShow = true;

			setTimeout(() => {
				this.isShow = false;
				this.color = 'green';

				setTimeout(() => {
					this.text = null;
				}, 500);
			}, closeTime);
		},
		close() {
			this.text = null;
			this.color = 'green';
			this.isShow = false;
		},
	}
})
