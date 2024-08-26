<template>
    <h1 class="font-bold text-2xl mb-5">Login to Fotofoshi</h1>
    <div
        class="flex flex-col justify-center items-center bg-white p-10 rounded-md"
    >
        <div>
            <form @submit.prevent="handleLogin" method="post">
                <div class="flex flex-col space-y-6">
                    <div class="flex flex-col text-normal font-light">
                        <label for="email" class="mb-1">Email</label>
                        <input
                            class="p-3 border border-gray-100 rounded-md w-96"
                            type="text"
                            name="email"
                            id="email"
                            v-model="form.email"
                            placeholder="Email"
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
                            placeholder="Password"
                        />
                        <p
                            class="text-red-600 text-sm pt-1"
                            v-if="authStore.errors.password"
                        >
                            {{ authStore.errors.password[0] }}
                        </p>
                    </div>
                </div>

                <button
                    type="submit"
                    value="Login"
                    class="bg-orange-300 w-full p-4 rounded-full text-white mt-10"
                >
                    Login
                </button>
            </form>
        </div>
        <p class="text-sm mt-10 text-gray-600">
            Don't have an account?
            <span class="text-orange-300"
                ><router-link to="register">Signup</router-link></span
            >
        </p>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

const form = reactive({
    email: "",
    password: "",
});

const handleLogin = () => {
    authStore.login(form);
};
</script>
<style></style>
