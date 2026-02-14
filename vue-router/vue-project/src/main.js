
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
import UserHeader from './components/UserHeader.vue'
import UserFooter from './components/UserFooter.vue'
import UserOrderHeader from './components/UserOrderHeader.vue'
import UserOrderFooter from './components/UserOrderFooter.vue'
import UserWishlistHeader from './components/UserWishlistHeader.vue'
import UserWishlistFooter from './components/UserWishlistFooter.vue'

const router = createRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/home',
            redirect: {
                // Cara 1: Redirect by name
                name: 'home'
                // Cara 2: Redirect by path
                // path: '/'
            }
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
            path: '/products/search/:product',
            redirect: route => {
                return {
                    name: 'product-search',
                    query: {
                        product: route.params.product
                    }
                }
            }
        },
        {
            path: '/users',
            name: 'user',
            component: User,
            children: [
                {
                    path: '',
                    name: 'user-profile',
                    components: {
                        default: UserProfile,
                        header: UserHeader,
                        footer: UserFooter
                    }
                },
                {
                    path: 'order',
                    name: 'user-order',
                    components: {
                        default: UserOrder,
                        header: UserOrderHeader,
                        footer: UserOrderFooter
                    }
                },
                {
                    path: 'wishlist',
                    name: 'user-wishlist',
                    components: {
                        default: UserWishlist,
                        header: UserWishlistHeader,
                        footer: UserWishlistFooter
                    }
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
