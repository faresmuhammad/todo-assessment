import './bootstrap';
import * as bootstrap from 'bootstrap'

import {createApp} from "vue";
import router from "./router.js";
import {createPinia} from "pinia";
import {useAuthStore} from "./stores/auth.js";
import mitt from "mitt";
import {emitter} from "./emitter.js";

const pinia = createPinia()
const app = createApp({})

app.use(router).use(pinia)
app.config.globalProperties.emitter = emitter

app.mount('#app')


const authStore = useAuthStore()
router.beforeEach(async (to, from, next) => {
    // check route required authentication
    // check user authenticated
    await authStore.checkUserAuthenticated()

    if (to.meta.requireAuth) {
        if (!authStore.isAuthenticated) next({name: 'login'})
        else next()
    } else next()
})
