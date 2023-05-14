import {createRouter, createWebHistory} from "vue-router";
import Index from "@/pages/Index.vue";
import Registration from "@/pages/Registration.vue";
import Login from "@/pages/Login.vue";
import Profile from "@/pages/Profile.vue";
import guest from "@/router/middleware/guest.js";
import auth from "@/router/middleware/auth.js";
import {useAuthStore} from "@stores/authStore.js";

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: "menu-link--active",
    routes: [
        {
            path: "/",
            name: "home",
            component: Index,
        },
        {
            path: "/registration",
            name: "registration",
            component: Registration,
            meta: {
                middleware: [
                    guest
                ]
            }
        },
        {
            path: "/login",
            name: "login",
            component: Login,
            meta: {
                middleware: [
                    guest
                ]
            }
        },
        {
            path: "/profile",
            name: "profile",
            component: Profile,
            meta: {
                middleware: [
                    auth
                ]
            }
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware
    const context = {
        to,
        from,
        next,
        store: useAuthStore()
    }
    return middleware[0]({
        ...context
    })
})

export default router;
