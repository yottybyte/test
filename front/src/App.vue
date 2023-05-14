<template>
  <Header/>
  <main class="content">
    <router-view v-slot="{ Component }">
      <transition name="page" mode="out-in">
        <component :is="Component" />
      </transition>
    </router-view>
  </main>
  <Footer/>
</template>

<script setup>
import Footer from "@components/base/Footer.vue";
import Header from "@components/base/Header.vue";

</script>

<style scoped>
.content {
  padding: 20px 0;
}
</style>
