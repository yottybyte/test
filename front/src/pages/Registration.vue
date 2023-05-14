<template>
  <div class="registration">
    <div class="container registration__wrapper">
      <h1 class="registration__title">Регистрация</h1>
      <Error class="registration__errors" :errors="errors" />
      <FormBase>
        <Input label="Имя" name="name" v-model:value="formData.name"/>
        <Input label="Фамилия" name="last-name" v-model:value="formData.last_name"/>
        <Input label="Email" name="email" v-model:value="formData.email"/>
        <Input label="Пароль" name="password" type="password" v-model:value="formData.password"/>
        <Input label="Повторите пароль" name="password-confirm" type="password" v-model:value="formData.password_confirmation"/>

        <Button @click.prevent="sendForm" type="submit">Зарегистрироваться</Button>
      </FormBase>
    </div>
  </div>
</template>

<script setup>
import Input from "@components/form/Input.vue";
import {inject, reactive, ref} from "vue";
import Button from "@components/form/Button.vue";
import FormBase from "@components/form/FormBase.vue";
import Error from "@components/form/Error.vue";
import {useCookies} from "vue3-cookies";
import {useAuthStore} from "@stores/authStore.js";
import {useRouter} from "vue-router";

const $axios = inject('$axios');
const authStore = useAuthStore();
const router = useRouter()

const formData = reactive({
  name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const errors = ref([])

async function sendForm() {
  errors.value = [];
  try {
    const response = await $axios.post("/auth/registration", formData);
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
.registration__title {
  text-align: center;
}
.registration__errors {
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}
</style>
