import {createRouter, createWebHistory} from "vue-router";

import HomePage from '../components/HomePage.vue';
import NestedPages1 from "../components/NestedPages1.vue";
import NestedPages2 from "../components/NestedPages2.vue";
import NestedPages3 from "../components/NestedPages3.vue";
import NestedPages4 from "../components/NestedPages4.vue";
import NotFound from "../components/NotFound.vue";

// Define Routes
const routes = [    
    {
        path: '/',
        redirect: '/page1',
        name: 'homePage',
        component: HomePage,
        children: [
          {path: '/page1', name: 'homePage', component: HomePage},
          
        ]
    },
    {path: '/page-1/page2/:slug/:id', name: 'Page2', component: NestedPages1,},
    {path: '/page-1/page3/:slug/:id', name: 'Page3', component: NestedPages2,},
    {path: '/page-1/page-3/page-4/:slug/:id', name: 'Page4', component: NestedPages3,},
    {path: '/page-5/:slug/:id', name: 'Page5', component: NestedPages4,},
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