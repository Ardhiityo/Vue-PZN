
import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory, createWebHashHistory, createMemoryHistory } from 'vue-router'

const router = createRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('./components/Home.vue'),
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
            component: () => import('./components/About.vue'),
            sensitive: true
        },
        {
            // (\\d+) : only numbers
            // ? : Optional param
            path: '/products/:id(\\d+)?',
            name: 'product-detail',
            component: () => import('./components/ProductDetail.vue'),
            // Mengubah parameter menjadi props ke component
            props: true
        },
        {
            path: '/products/search',
            name: 'product-search',
            component: () => import('./components/ProductSearch.vue'),
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
            // Lazy loading dengan import() agar tidak memuat semua component sekaligus, hanya dimuat ketika akan diakses
            component: () => import('./components/User.vue'),
            children: [
                {
                    path: '',
                    name: 'user-profile',
                    components: {
                        default: () => import('./components/UserProfile.vue'),
                        header: () => import('./components/UserHeader.vue'),
                        footer: () => import('./components/UserFooter.vue')
                    }
                },
                {
                    path: 'order',
                    name: 'user-order',
                    components: {
                        default: () => import('./components/UserOrder.vue'),
                        header: () => import('./components/UserOrderHeader.vue'),
                        footer: () => import('./components/UserOrderFooter.vue')
                    }
                },
                {
                    path: 'wishlist',
                    name: 'user-wishlist',
                    components: {
                        default: () => import('./components/UserWishlist.vue'),
                        header: () => import('./components/UserWishlistHeader.vue'),
                        footer: () => import('./components/UserWishlistFooter.vue')
                    }
                },
            ]
        },
        {
            path: '/:notfound*',
            name: 'not-found',
            component: () => import('./components/NotFound.vue')
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
