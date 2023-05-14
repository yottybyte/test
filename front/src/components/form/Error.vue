<template>
  <div class="errors" v-if="isErrors">
    <ul class="errors__list">
      <li class="errors__item" v-for="(item, index) in errorList" :key="index">
        {{ item[0] }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
  errors: {
    type: Object,
    required: false,
    default: {}
  }
})

const isErrors = computed(() => {
  return !!Object.keys(props.errors).length
})

const errorList = computed(() => {
  const errors = [];
  for (let key in props.errors) {
    errors.push(props.errors[key])
  }

  return errors
})
</script>

<style scoped>
.errors {
  color: #721c24;
  background-color: #f8d7da;
  border-color: #f5c6cb;
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 6px;
}
.errors__list {
  list-style: none;
  margin: 0;
  padding: 0;
}
.errors__item {
  font-size: 16px;
  line-height: 22px;
}
</style>
