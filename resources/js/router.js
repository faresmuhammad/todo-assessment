import {createRouter, createWebHistory} from "vue-router";
import App from "./Pages/App.vue";
import Register from "./Pages/Auth/Register.vue";
import Login from "./Pages/Auth/Login.vue";
import NewTask from "./Pages/Task.vue";
import Task from "./Pages/Task.vue";


const routes = [
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/',
        name: 'app',
        component: App,
        meta: {requireAuth: true}
    },
    {
        path: '/tasks/new',
        name: 'new-task',
        component: Task,
        meta: {requireAuth: true}
    },
    {
        path: '/tasks/edit/:id',
        name: 'edit-task',
        component: Task,
        meta: {requireAuth: true}
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
