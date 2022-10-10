import {createRouter, createWebHistory} from "vue-router";

import HomePage from '../components/HomePage.vue';
import NotFound from "../components/NotFound.vue";

// Define Routes
const routes = [    
    {
        path: '/',
        name: 'homePage',
        component: HomePage,
        meta: {title: 'HomePage'},
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: NotFound,
      meta: {title: '404 | Not Found'},
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
})
const DEFAULT_TITLE = 'Create Pages';

// router.beforeEach((to, from, next) => {
//   document.title = to.meta.title || DEFAULT_TITLE;
// });

export default router;