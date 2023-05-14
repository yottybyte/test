<template>
  <header class="header">
    <div class="container header__wrapper">
      <div class="header__logo">
        <router-link to="/" class="header__logo-link">LOGO</router-link>
      </div>
      <nav class="header__nav">
        <button class="header__nav-button" @click="isOpenMenu = !isOpenMenu">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc.--><path d="M0 96c0-18 14-32 32-32h384a32 32 0 1 1 0 64H32c-18 0-32-14-32-32zm0 160c0-18 14-32 32-32h384a32 32 0 1 1 0 64H32c-18 0-32-14-32-32zm448 160c0 18-14 32-32 32H32a32 32 0 1 1 0-64h384c18 0 32 14 32 32z"/></svg>
        </button>
        <ul class="header__menu" :class="{ 'header__menu--active': isOpenMenu }">
          <li class="header__menu-item">
            <router-link to="/" class="header__menu-link" @click="isOpenMenu = false">Главная</router-link>
          </li>
          <li class="header__menu-item" v-if="!authStore.isAuth">
            <router-link to="/registration" class="header__menu-link" @click="isOpenMenu = false">Регистрация</router-link>
          </li>
          <li class="header__menu-item" v-if="!authStore.isAuth">
            <router-link to="/login" class="header__menu-link" @click="isOpenMenu = false">Вход</router-link>
          </li>
          <li class="header__menu-item" v-if="authStore.isAuth">
            <router-link to="/profile" class="header__menu-link" @click="isOpenMenu = false">Только авторизованному</router-link>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script setup>
import {useAuthStore} from "@stores/authStore.js";
import {ref} from "vue";

const authStore = useAuthStore()
const isOpenMenu = ref(false)
</script>

<style scoped>
.header {
  padding: 24px 0;
  background: rgba(245, 245, 245 ,0.75);
  backdrop-filter: blur(12px);
}
.header__wrapper {
  width: 100%;
  display: grid;
  grid-template-columns: 100px minmax(0, 1fr);
  align-items: center;
}

.header__logo {
  font-size: 20px;
  font-weight: 600;
}
.header__logo-link {
  text-decoration: none;
  color: inherit;
}

.header__nav {}

.header__nav-button {
  padding: 0;
  border: none;
  background: none;
  display: none;
  margin-left: auto;
}

.header__nav-button svg {
  width: 20px;
  height: auto;
}

.header__menu {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  gap: 20px
}
.header__menu-item {
}
.header__menu-link {
  text-decoration: none;
  color: #000000;
  border-bottom: 1px solid transparent;
  transition: .3s;
}
.header__menu-link:hover {
  border-bottom-color: #000000;
}

.header__menu-link.menu-link--active {
  border-bottom-color: #000000;
}

@media screen and (max-width: 991px) {
  .header__nav-button {
    display: block;
  }

  .header__menu {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 74px;
    background: #f8f7f7;
    left: 0;
    width: 100%;
    padding: 20px 10px;
    box-shadow: 0 5px 5px #00000066;
    align-items: center;
  }

  .header__menu--active {
    display: flex;
  }
}
</style>
