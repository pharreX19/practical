import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            name: "login",
            component: () => import("../pages/Login.vue"),
            meta: { guest: true },
        },
        {
            path: "/home",
            name: "home",
            component: () => import("../pages/Home.vue"),
            meta: { auth: true },
        },
        {
            path: "/image-detail/:image",
            name: "image-detail",
            component: () => import("../pages/ImageDetail.vue"),
            meta: { auth: true },
        },
        {
            path: "/register",
            name: "register",
            component: () => import("../pages/Register.vue"),
            meta: { guest: true },
        },
        {
            path: "/create",
            name: "create",
            component: () => import("../pages/CreateImage.vue"),
            meta: { auth: true },
        },
        {
            path: "/settings",
            name: "settings",
            component: () => import("../pages/Settings.vue"),
            // meta: { guest: true },
        },
        {
            path: "/:pathMatch(.*)*",
            component: () => import("../pages/404.vue"),
            // meta: { guest: true },
        },
    ],
});

router.beforeEach(async (to, from) => {
    const authStore = useAuthStore();
    await authStore.getUser();
    console.log("from router", authStore.user);

    if (authStore.user && to.meta.guest) {
        return { name: "home" };
    }

    if (!authStore.user && to.meta.auth) {
        return { name: "login" };
    }
    // return next;
});

export default router;
