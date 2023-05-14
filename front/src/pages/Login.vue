<template>
  <div class="login">
    <div class="container login__wrapper">
      <h1 class="login__title">Авторизация</h1>
      <Error class="login__errors" :errors="errors" />
      <FormBase>
        <Input label="Email" name="email" v-model:value="formData.email"/>
        <Input label="Пароль" name="password" type="password" v-model:value="formData.password"/>

        <Button @click.prevent="sendForm" type="submit">Войти</Button>
      </FormBase>
    </div>
  </div>
</template>

<script setup>
import Input from "@components/form/Input.vue";
import {inject, reactive, ref} from "vue";
import Button from "@components/form/Button.vue";
import FormBase from "@components/form/FormBase.vue";
import {useCookies} from "vue3-cookies";
import {useAuthStore} from "@stores/authStore.js";
import Error from "@components/form/Error.vue";
import {useRouter} from "vue-router";

const $axios = inject('$axios');
const authStore = useAuthStore();
const router = useRouter()

const formData = reactive({
  email: '',
  password: '',
})

const errors = ref([])

async function sendForm() {
  errors.value = [];
  try {
    const response = await $axios.post("/auth/login", formData);
    await authStore.auth(response.data.token)

    await router.push('/profile')
  } catch (e) {
    if(e.response.status === 422) {
      errors.value = e.response.data.errors
    } else {
      errors.value = {
        'undefined': 'Что то пошло не так, попробуйте позже'
      }
    }
  }
}
</script>

<style scoped>
.login__title {
  text-align: center;
}
.login__errors {
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}
</style>
