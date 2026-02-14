
import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory, createWebHashHistory, createMemoryHistory } from 'vue-router'

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
            component: Home,
            props: {
                title: 'Home Page'
            }
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
            component: ProductDetail,
            // Mengubah parameter menjadi props ke component
            props: true
        },
        {
            path: '/products/search',
            name: 'product-search',
            component: ProductSearch,
            // Mengubah query menjadi props ke component
            props: route => ({
                product: route.query.product
            })
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
    /**
     History Mode 1: createWebHistory() -> http://localhost:5173/products/search?product=sony
     Note: Tidak ada tanda # di url
     
     History Mode 2: createWebHashHistory() -> http://localhost:5173/#/products/search?product=sony 
     Note: Selalu ada tanda # di url
     
     History Mode 3: createMemoryHistory() -> http://localhost:5173
     Note: Tidak bisa diakses melalui url, hanya bisa diakses melalui link di dalam aplikasi
     */
    // history: createWebHashHistory()
    // history: createMemoryHistory()
    history: createWebHistory()
})

createApp(App).use(router).mount('#app')
