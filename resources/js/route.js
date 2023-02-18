import * as VueRoute from 'vue-router';
import Index from "./components/Index.vue";
import Login from "./components/Login.vue";
import Registration from "./components/Registration.vue";
import AddProduct from "./components/AddProduct.vue";
import AddSupply from "./components/AddSupply.vue";


const routes = [
    {
        path: '/',
        name: 'home',
        component: Index
    },

    {
        path: '/',
        name: 'login',
        component: Login
    },

    {
        path: '/',
        name: 'registration',
        component: Registration
    },

    {
        path: '/product',
        name: 'product',
        component: AddProduct
    },

    {
        path: '/supply',
        name: 'supply',
        component: AddSupply
    },
];


const router = VueRoute.createRouter({
    history: VueRoute.createWebHistory("/"),
    routes
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');

    if (token) {
        if (to.name === 'login' || to.name === 'registration') {
            return next({
                name: "home"
            })
        }
    }

    return next();
})

export default router

