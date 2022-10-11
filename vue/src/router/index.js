import {createRouter, createWebHistory} from "vue-router";

import HomePage from '../components/HomePage.vue';
import NotFound from "../components/NotFound.vue";

// Define Routes
const routes = [    
    {
        path: '/',
        name: 'homePage',
        component: HomePage,
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: NotFound,
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;