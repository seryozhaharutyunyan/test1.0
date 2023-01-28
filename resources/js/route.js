import * as VueRoute from 'vue-router';
import Index from "./components/Index.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Index
    },
];


const router = VueRoute.createRouter({
    history: VueRoute.createWebHistory("/"),
    routes
})

export default router

