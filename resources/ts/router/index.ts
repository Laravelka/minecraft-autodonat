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
    {
        path: '/admin/users',
        name: 'AdminUsers',
        meta: {
            requiresAuth: true
        },
        component: () => import('@/pages/Admin/UsersPage.vue')
    },
    {
        path: '/admin/categories',
        name: 'AdminCategories',
        meta: {
            requiresAuth: true
        },
        component: () => import('@/pages/Admin/CategoriesPage.vue')
    },
    {
        path: '/admin/products',
        name: 'AdminProducts',
        meta: {
            requiresAuth: true
        },
        component: () => import('@/pages/Admin/ProductsPage.vue')
    },
    {
        path: '/admin/servers',
        name: 'AdminServers',
        meta: {
            requiresAuth: true
        },
        component: () => import('@/pages/Admin/ServersPage.vue')
    },
    {
        path: '/admin/promocodes',
        name: 'AdminPromocodes',
        meta: {
            requiresAuth: true
        },
        component: () => import('@/pages/Admin/PromocodesPage.vue')
    },
    {
        path: '/admin/purchaseHistory',
        name: 'AdminPurchaseHistory',
        meta: {
            requiresAuth: true
        },
        component: () => import('@/pages/Admin/PurchaseHistoryPage.vue')
    },
    {
        path: '/admin/',
        name: 'AdminIndexPage',
        meta: {
            requiresAuth: true
        },
        component: () => import('@/pages/Admin/IndexPage.vue')
    },

    //AdminIndexPage
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
