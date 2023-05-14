import axios from 'axios';
import {useCookies} from "vue3-cookies";

export default {
    install: (app) => {
        axios.defaults.baseURL = 'http://localhost:8000/api';
        axios.defaults.headers.common = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": getAuthToken()
        }

        axios.interceptors.request.use((config) => {
            config.headers.Authorization = getAuthToken();
            return config;
        });

        if(app.config.globalProperties.$pinia) {
            app.config.globalProperties.$pinia.use(() => ({ $axios: axios }));
        }

        app.provide('$axios', axios);
    }
}

function getAuthToken() {
    const { cookies } = useCookies();
    return `Bearer ${cookies.get('token')}`
}
