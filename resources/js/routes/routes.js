import {createRouter, createWebHistory} from 'vue-router';


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/index',
            component: () => import('../views/Index.vue')
        },
        {
            path: '/page',
            component: () => import('../views/Page.vue')
        }
    ]
});

export default router;
