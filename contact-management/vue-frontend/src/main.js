import { createApp } from 'vue'
import App from './App.vue'

import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    routes: [
        {
            path: '/login',
            name: 'login',
            component: () => import('./components/pages/auth/Login.vue')
        },
        {
            path: '/register',
            name: 'register',
            component: () => import('./components/pages/auth/Register.vue')
        },
        {
            path: '/',
            name: 'dashboard',
            component: () => import('./components/pages/Dashboard.vue')
        }
    ],
    history: createWebHistory()
})

createApp(App).use(router).mount('#app')
