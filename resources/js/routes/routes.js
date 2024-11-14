import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: () => import("../views/Index.vue"),
            name: "home",
        },
        {
            path: "/users",
            component: () => import("../views/Users.vue"),
            name: "users",
        },
        {
            path: "/users/:id/posts",
            component: () => import("../views/UserPosts.vue"),
            name: "user.posts",
        },
        {
            path: "/personal",
            component: () => import("../views/Personal.vue"),
            name: "personal",
        },
        {
            path: "/page",
            component: () => import("../views/Page.vue"),
            name: "page",
        },
        {
            path: "/user/login",
            component: () => import("../views/Login.vue"),
            name: "user.login",
        },
        {
            path: "/user/registration",
            component: () => import("../views/Registration.vue"),
            name: "user.registration",
        },
    ],
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token");
    if (!token) {
        if (to.name === "user.login" || to.name === "user.registration") {
            return next();
        } else {
            return next({ name: "user.login" });
        }
    }else{
        return next();
    }
});

export default router;
