import { createApp } from 'vue'
import './style.css'
import axios from "@/plugins/axios";
import App from './App.vue'
import router from "./router";
import {createPinia} from "pinia";
import {useAuthStore} from "@stores/authStore.js";



const pinia = createPinia()
const app = createApp(App);
app.use(pinia)
app.use(axios);

const authStore = useAuthStore()
await authStore.auth()

app.use(router)

app.mount('#app')
