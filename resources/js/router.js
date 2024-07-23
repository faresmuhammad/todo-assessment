import {createRouter, createWebHistory} from "vue-router";
import App from "./Pages/App.vue";
import Register from "./Pages/Auth/Register.vue";
import Login from "./Pages/Auth/Login.vue";


const routes = [
    {
        path: '/',
        name: 'app',
        component: App,
        meta: {requireAuth: true}
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
