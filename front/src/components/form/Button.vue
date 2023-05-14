<template>
  <button class="button" :type="props.type">
    <slot/>
  </button>
</template>

<script setup>
const props = defineProps({
  type: {
    type: String,
    required: false,
    default: 'button'
  }
})
</script>

<style scoped>
.button {
  padding: 10px;
  font-size: 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  background: #eee;
  transition: .3s;
}
.button:hover {
  background: #e1e1e1;
}
</style>
