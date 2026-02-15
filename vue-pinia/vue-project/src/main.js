import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    routes: [
        {
            path: '/counter',
            name: 'counter',
            component: () => import('./components/MultipleCounter.vue')
        }
    ],
    history: createWebHistory()
})

const pinia = createPinia()

createApp(App).use(pinia).use(router).mount('#app')
