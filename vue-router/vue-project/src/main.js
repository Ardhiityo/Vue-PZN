
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
            name: 'Home',
            component: Home
        },
        {
            path: '/about',
            name: 'About',
            component: About,
            sensitive: true
        },
        {
            // (\\d+) : only numbers
            // ? : Optional param
            path: '/products/:id(\\d+)?',
            name: 'ProductDetail',
            component: ProductDetail
        },
        {
            path: '/products/search',
            name: 'ProductSearch',
            component: ProductSearch
        },
        {
            path: '/users',
            name: 'User',
            component: User,
            children: [
                {
                    path: '',
                    name: 'UserProfile',
                    component: UserProfile
                },
                {
                    path: 'order',
                    name: 'UserOrder',
                    component: UserOrder
                },
                {
                    path: 'wishlist',
                    name: 'UserWishlist',
                    component: UserWishlist
                },
            ]
        },
        {
            path: '/:notfound*',
            name: 'NotFound',
            component: NotFound
        },
    ],
    history: createWebHistory()
})

createApp(App).use(router).mount('#app')
