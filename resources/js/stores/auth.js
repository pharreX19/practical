import axios from "axios";
import { defineStore } from "pinia";
import instance from "../axios";

export const useAuthStore = defineStore("authStore", {
    state: () => {
        return {
            user: null,
            errors: {},
        };
    },
    getters: {},
    actions: {
        async getUser() {
            try {
                const response = await instance.get("user");
                this.user = response.data;
            } catch (e) {
                this.errors = e;
            }
        },
        async register(data) {
            try {
                const response = await instance.post("auth/register", data);
                if (response.status == 200 && response.data) {
                    this.router.push({ name: "login" });
                }
            } catch (e) {
                console.log("from errors", e);
                this.errors = e;
            }
        },

        async login(data) {
            try {
                await instance.get("sanctum/csrf-cookie");
                const result = await instance.post("auth/login", data);
                this.router.push({ name: "home" });
            } catch (e) {
                this.errors = e;
            }
        },

        async logout() {
            try {
                const result = await instance.post("auth/logout");
                this.user = null;
                this.router.push({ name: "login" });
            } catch (e) {
                this.errors = e;
            }
        },
    },
});
