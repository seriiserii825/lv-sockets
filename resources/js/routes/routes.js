import {createRouter, createWebHistory} from 'vue-router';

import Index from '../views/Index.vue';
import Page from '../views/Page.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/index',
            component: Index
        },
        {
            path: '/page',
            component: Page
        }
    ]
});

export default router;
