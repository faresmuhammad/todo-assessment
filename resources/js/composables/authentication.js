import {BaseUrl} from "../constants.js";
import router from "../router.js";
import {useAuthStore} from "../stores/auth.js";

export const useAuthentication = () => {

    /**
     * Register new user
     * @param data - reactive form data
     * @returns {Promise<void>}
     */
    const register = async (data) => {
        try {
            const response = await axios.post(BaseUrl + '/register', data)
            await router.push({name: 'app'})

        } catch (e) {
            console.error(e)
        }

    }

    /**
     * Authenticate the user
     * @param data - reactive form data
     * @returns {Promise<void>}
     */
    const login = async (data) => {
        try {
            const response = await axios.post(BaseUrl + '/login', data)
            await useAuthStore().checkUserAuthenticated()
            await router.push({name: 'app'})
        } catch (e) {
            console.error(e)
        }
    }

    /**
     * Logout the authenticated user
     * @returns {Promise<void>}
     */
    const logout = async () => {
        try {
            const response = await axios.post(BaseUrl + '/logout')
            await router.push({name: 'login'})
        } catch (e) {
            console.error(e)
        }
    }

    return {register, login, logout}

}
