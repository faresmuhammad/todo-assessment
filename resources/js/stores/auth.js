import {defineStore} from "pinia";
import {BaseUrl} from "../constants.js";


export const useAuthStore = defineStore('auth', {
    //set authenticated, user states
    state: () => {
        return {
            isAuthenticated: false,
            user: null
        }
    },
    actions: {
        async checkUserAuthenticated() {
            const response = await axios.get(BaseUrl + '/user')
            if (response.data.user === null) {
                this.isAuthenticated = false
                this.user = null
            } else {
                this.isAuthenticated = true
                this.user = response.data.user
            }

        }
    }
})
