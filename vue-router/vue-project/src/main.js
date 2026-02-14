import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHashHistory } from 'vue-router'

const router = createRouter({
    routes: [],
    history: createWebHashHistory()
})

createApp(App).use(router).mount('#app')
