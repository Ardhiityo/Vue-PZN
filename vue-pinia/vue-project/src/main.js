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
        },
        {
            path: '/todolist',
            children: [
                {
                    path: '',
                    name: 'list-todolist',
                    component: () => import('./components/ListTodo.vue')
                },
                {
                    path: 'add',
                    name: 'add-todolist',
                    component: () => import('./components/AddTodo.vue')
                },
                {
                    path: ':id/update',
                    name: 'update-todolist',
                    component: () => import('./components/UpdateTodo.vue'),
                    props: true
                }
            ]
        }
    ],
    history: createWebHistory()
})

const pinia = createPinia()

createApp(App).use(pinia).use(router).mount('#app')
