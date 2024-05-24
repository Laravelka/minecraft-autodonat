import { defineStore } from 'pinia'
import axios from "axios";
import { User } from "../types/User";
import config from "../config";

export const useUserStore = defineStore({
	id: 'user',
	state: () => ({
		loading: false,
		message: null,
		errors: {},
		token: null,
		user: {},
	}),
	getters: {
		getUser(): User|undefined {
			return this.user?.id !== undefined ? this.user : JSON.parse(localStorage.user ?? '{}');
		},
		isAuth() {
			return localStorage.hasOwnProperty('token') &&
				localStorage.hasOwnProperty('user');
		}
	},
	actions: {
		updateUser(callback = null) {
			this.loading = true
			axios.get(`${config.host}/api/user`).then(({ data }) => {
				this.user = data.data;
				localStorage.setItem('user', JSON.stringify(this.user));

				if (callback != null) callback(this.user);
			}).catch(this.axiosCatchCallback);
		},
		update(data, callback = null) {
			axios.post(`${config.host}/api/user/update`, data).then(({ data }) => {
				this.user = data.data;
				localStorage.setItem('user', JSON.stringify(this.user));

				if (callback) callback(data);
			}).catch(
				(error) => this.axiosCatchCallback(error, callback)
			);
		},
		login(data, callback = null) {
			this.auth(data, 'login', callback)
		},
		logout() {
			this.user = null;
			this.token = null;
			localStorage.removeItem('user');
			localStorage.removeItem('token');

			location.href = '/';
		},
		register(data, callback = null) {
			this.auth(data, 'register', callback)
		},
		auth(data, type, callback = null) {
			axios.get(`${config.host}/sanctum/csrf-cookie`).then(response => {
				axios.post(`${config.host}/api/auth/${type}`, data).then(response => {
					this.user = response.data.user;
					this.token = response.data.token;

					localStorage.setItem('user', JSON.stringify(this.user));
					localStorage.setItem('token', this.token);

					if (callback) callback(response.data);
				}).catch(
					(error) => this.axiosCatchCallback(error, callback)
				);
			});
		},
		axiosCatchCallback(error, callback) {
			const {response} = error;

			if (response?.data) {
				callback(response.data, true);
			}

			console.error(error);

			if (response?.data?.errors) {
				this.errors = response.data.errors;
			} else if (response?.data?.error == true) {
				this.message = response.data.message;
			} else {
				this.message = error.message;
			}

			setTimeout(() => {
				this.errors = [];
				this.message = null;
			}, 2500);
		}

	}
})
