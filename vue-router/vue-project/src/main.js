
import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'

import Home from './components/Home.vue'
import About from './components/About.vue'
import ProductDetail from './components/ProductDetail.vue'

const router = createRouter({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/about',
            name: 'About',
            component: About
        },
        {
            path: '/products/:id(\\d+)', // only numbers
            name: 'ProductDetail',
            component: ProductDetail
        }
    ],
    history: createWebHistory()
})

createApp(App).use(router).mount('#app')
