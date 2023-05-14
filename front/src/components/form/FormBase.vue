<template>
  <form class="form">
    <slot/>
  </form>
</template>

<style scoped>
.form {
  display: flex;
  flex-direction: column;
  gap: 20px;
  max-width: 400px;
  margin: 0 auto;
}
</style>
