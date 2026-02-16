import { createApp } from 'vue'
import App from './App.vue'
import './assets/main.css'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    routes: [
        {
            path: '/auth',
            component: () => import('./components/layouts/Auth.vue'),
            children: [
                {
                    path: 'login',
                    name: 'auth.login',
                    component: () => import('./components/pages/auth/Login.vue')
                },
                {
                    path: 'register',
                    name: 'auth.register',
                    component: () => import('./components/pages/auth/Register.vue')
                },
                {
                    path: 'logout',
                    name: 'auth.logout',
                    component: () => import('./components/pages/auth/Logout.vue')
                },
            ]
        },
        {
            path: '/dashboard',
            component: () => import('./components/layouts/Dashboard.vue'),
            children: [
                {
                    path: '',
                    name: 'dashboard',
                    component: () => import('./components/pages/Dashboard.vue')
                },
                {
                    path: 'users/profile',
                    name: 'dashboard.profile',
                    component: () => import('./components/pages/UserProfile.vue')
                }
            ]
        }
    ],
    history: createWebHistory()
})

createApp(App).use(router).mount('#app')
