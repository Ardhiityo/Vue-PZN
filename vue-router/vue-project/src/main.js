
import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'

import Home from './components/Home.vue'
import About from './components/About.vue'
import ProductDetail from './components/ProductDetail.vue'
import ProductSearch from './components/ProductSearch.vue'
import User from './components/User.vue'
import UserProfile from './components/UserProfile.vue'
import UserOrder from './components/UserOrder.vue'
import UserWishlist from './components/UserWishlist.vue'
import NotFound from './components/NotFound.vue'

const router = createRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            sensitive: true
        },
        {
            // (\\d+) : only numbers
            // ? : Optional param
            path: '/products/:id(\\d+)?',
            name: 'product-detail',
            component: ProductDetail
        },
        {
            path: '/products/search',
            name: 'product-search',
            component: ProductSearch
        },
        {
            path: '/users',
            name: 'user',
            component: User,
            children: [
                {
                    path: '',
                    name: 'user-profile',
                    component: UserProfile
                },
                {
                    path: 'order',
                    name: 'user-order',
                    component: UserOrder
                },
                {
                    path: 'wishlist',
                    name: 'user-wishlist',
                    component: UserWishlist
                },
            ]
        },
        {
            path: '/:notfound*',
            name: 'not-found',
            component: NotFound
        },
    ],
    history: createWebHistory()
})

createApp(App).use(router).mount('#app')
