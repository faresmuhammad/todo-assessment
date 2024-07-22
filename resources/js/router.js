import {createRouter, createWebHistory} from "vue-router";
import App from "./Pages/App.vue";
import TestPage from "./Pages/TestPage.vue";

const routes = [
    {
        path: '/',
        name: 'app',
        component: App
    },
    {
        path: '/test',
        name: 'test',
        component: TestPage
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
