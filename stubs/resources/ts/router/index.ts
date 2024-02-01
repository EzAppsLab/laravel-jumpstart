import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import HelloView from '../views/HelloView.vue'
import AboutView from '../views/AboutView.vue'

const router = createRouter({
    history: createWebHistory('/'),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/hello-world',
            name: 'hello-world',
            component: HelloView
        },
        {
            path: '/about',
            name: 'about',
            component: AboutView
        }
    ]
})

export default router
