import {defineStore} from "pinia";
import {inject} from "vue";
import {useCookies} from "vue3-cookies";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        isAuth: false,
        user: null,
    }),
    getters: {},
    actions: {
        async auth(token){
            if(token) {
                const { cookies } = useCookies();
                cookies.set("token", token);
            }

            try {
                const response = await this.$axios.get("/user");

                this.isAuth = true
                this.user = response.data
            } catch (e) {
                this.isAuth = false
            }

            return this.isAuth;
        }
    },
})
