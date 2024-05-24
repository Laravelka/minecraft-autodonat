import { createRouter, createWebHistory } from "vue-router";
import {storeToRefs} from "pinia";
import {useUserStore} from "../store/UserStore";


const routes = [
    {
        path: '/:catchAll(.*)',
        component: () => import('@/pages/NotFoundPage.vue')
    },
    {
        path: '/',
        component: () => import('@/pages/HomePage.vue')
    },
    {
        path: '/login',
        name: 'Login',
        meta: {
            requiresAuth: false
        },
        component: () => import('@/pages/Auth/LoginPage.vue')
    },
    {
        path: '/register',
        name: 'Register',
        meta: {
            requiresAuth: false
        },
        component: () => import('@/pages/Auth/RegisterPage.vue')
    },
    {
        path: '/profile',
        name: 'Profile',
        meta: {
            requiresAuth: true
        },
        component: () => import('@/pages/ProfilePage.vue')
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes
});


router.beforeEach(async (to, from, next) => {
    const userStore = useUserStore();
    const {isAuth} = storeToRefs(userStore);

    if (to.meta?.requiresAuth == true && !isAuth.value) {
        await router.push({name: 'Login'});
    } else if (to.meta?.requiresAuth == false && isAuth.value) {
        await router.push({name: 'Profile'});
    }

    next();
});


export default router;
