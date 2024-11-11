import {createRouter, createWebHistory} from 'vue-router';


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: () => import('../views/Index.vue'),
            name: 'home'
        },
        {
            path: '/page',
            component: () => import('../views/Page.vue'),
            name: 'page'
        },
        {
            path: '/user/login',
            component: () => import('../views/Login.vue'),
            name: 'user.login'
        },
        {
            path: '/user/registration',
            component: () => import('../views/Registration.vue'),
            name: 'user.registration'
        }
    ]
});

export default router;
