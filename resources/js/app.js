import './bootstrap';
import {createApp} from "vue";
import router from "./router.js";
import {createPinia} from "pinia";
import {useAuthStore} from "./stores/auth.js";

const pinia = createPinia()
const app = createApp({})


app.use(pinia).use(router)
    .mount('#app')


const authStore = useAuthStore()
router.beforeEach(async (to, from, next) => {
    // check route required authentication
    // check user authenticated
    await authStore.checkUserAuthenticated()

    if (to.meta.requireAuth && !authStore.isAuthenticated) next({name: 'login'})
    else if (authStore.isAuthenticated && to.name === 'login' || to.name === 'register') next({name: 'app'})
    else next()
})
