import * as VueRoute from 'vue-router';
import Index from "./components/Index.vue";
import Login from "./components/Login.vue";
import Registration from "./components/Registration.vue";


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
];



const router = VueRoute.createRouter({
    history: VueRoute.createWebHistory("/"),
    routes
})

router.beforeEach((to, from, next)=>{
    const token=localStorage.getItem('token');

    if(!token){
        if(to.name==='login' || to.name==='home' || to.name==='registration'){
            return next();
        }else {
            return next({
                name: 'login'
            })
        }

    }else {
        if (to.name==='login' || to.name==='registration'){
            return next({
                name: "home"
            })
        }
    }

    return next();
})

export default router

