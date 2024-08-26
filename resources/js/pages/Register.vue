<template>
    <h1 class="font-bold text-2xl mb-5">Login to Fotofoshi</h1>
    <div
        class="flex flex-col justify-center items-center bg-white p-10 rounded-md"
    >
        <div>
            <form @submit.prevent="register">
                <div class="flex flex-col space-y-6">
                    <div class="flex flex-col text-normal font-light">
                        <label for="name" class="mb-1">Full Name</label>
                        <input
                            class="p-3 border border-gray-100 rounded-md w-96"
                            type="text"
                            name="name"
                            id="name"
                            v-model="form.name"
                        />
                        <p
                            class="text-red-600 text-sm pt-1"
                            v-if="authStore.errors.name"
                        >
                            {{ authStore.errors.name[0] }}
                        </p>
                    </div>

                    <div class="flex flex-col text-normal font-light">
                        <label for="email" class="mb-1">Email</label>
                        <input
                            class="p-3 border border-gray-100 rounded-md w-96"
                            type="email"
                            name="email"
                            id="email"
                            v-model="form.email"
                        />
                        <p
                            class="text-red-600 text-sm pt-1"
                            v-if="authStore.errors.email"
                        >
                            {{ authStore.errors.email[0] }}
                        </p>
                    </div>

                    <div class="flex flex-col text-normal font-light">
                        <label for="password" class="mb-1">Password</label>
                        <input
                            class="p-3 border border-gray-100 rounded-md w-96"
                            type="password"
                            name="password"
                            id="password"
                            v-model="form.password"
                        />
                        <p
                            class="text-red-600 text-sm pt-1"
                            v-if="authStore.errors.password"
                        >
                            {{ authStore.errors.password[0] }}
                        </p>
                    </div>

                    <div class="flex flex-col text-normal font-light">
                        <label for="password_confirmation" class="mb-1"
                            >Password Confirmation</label
                        >
                        <input
                            class="p-3 border border-gray-100 rounded-md w-96"
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                        />
                        <p
                            class="text-red-600 text-sm pt-1"
                            v-if="authStore.errors.password_confirmation"
                        >
                            {{ authStore.errors.password_confirmation[0] }}
                        </p>
                    </div>
                </div>

                <button
                    type="submit"
                    value="Login"
                    class="bg-orange-300 w-full p-4 mt-10 rounded-full text-white"
                >
                    Sign Up
                </button>
            </form>
        </div>
        <p class="text-sm mt-10 text-gray-600">
            Already have an account?
            <span class="text-orange-300"
                ><router-link :to="{ name: 'login' }">Login</router-link></span
            >
        </p>
    </div>
</template>
<script setup>
import { reactive } from "vue";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore(); // storeToRefs(useAuthStore());

const form = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const register = () => {
    authStore.register(form);
};
</script>
<style></style>
