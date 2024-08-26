<template>
    <nav>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <router-link
                        :to="{ name: 'home' }"
                        class="text-xl font-bold text-gray-900"
                        >Fotofoshi</router-link
                    >
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <router-link
                            :to="{ name: 'settings' }"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                            >Settings</router-link
                        >
                        <router-link
                            :to="{ name: 'create' }"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                            >Post a photo</router-link
                        >
                        <Menu
                            v-if="authStore.user"
                            as="div"
                            class="relative inline-block text-left"
                        >
                            <div>
                                <MenuButton
                                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                >
                                    {{ authStore.user.name }}
                                    <ChevronDownIcon
                                        class="-mr-1 h-5 w-5 text-gray-400"
                                        aria-hidden="true"
                                    />
                                </MenuButton>
                            </div>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div class="py-1">
                                        <button
                                            class="block w-full px-4 py-2 text-left text-sm"
                                            @click="logout"
                                        >
                                            Logout
                                        </button>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- h-[90vh] -->
    <main
        class="bg-gray-100 flex flex-col justify-center items-center h-screen relative"
    >
        <router-view></router-view>
    </main>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { useAuthStore } from "./stores/auth";

const authStore = useAuthStore();

const logout = () => {
    authStore.logout();
};
</script>
