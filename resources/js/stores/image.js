import { defineStore } from "pinia";
import instance from "../axios";

export const useImageStore = defineStore("imageStore", {
    state: () => {
        return {
            images: [],
            image: {},
            errors: {},
            next_page_url: null,
        };
    },
    actions: {
        async createImage(data) {
            try {
                console.log(data);
                const response = await instance.post("photos", data, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.router.push({ name: "home" });
            } catch (error) {
                this.errors = error;
            }
        },
        async getImages() {
            try {
                const response = await instance.get("photos");
                console.log("images fetched", response.data.data);
                this.images = response.data.data;
                this.next_page_url = response.data.next_page_url;
            } catch (error) {
                this.errors = error;
            }
        },

        async getImage(id) {
            try {
                const response = await instance.get(`photos/${id}`);
                this.image = response.data;
            } catch (error) {
                this.errors = error;
            }
        },

        async deleteImage(id) {
            try {
                const response = await instance.delete(`photos/${id}`);
                this.image = {};
                this.router.back();
            } catch (error) {
                console.log("here comes the error ", error);
                this.errors = error;
            }
        },
    },
});
