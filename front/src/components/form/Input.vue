<template>
  <div class="input">
    <label class="input__label" :for="props.name">{{ props.label }}</label>
    <input class="input__input" :type="props.type" :name="props.name" @input="emitValue($event)" :value="props.value">
  </div>
</template>

<script setup>
const props = defineProps({
  label: String,
  name: String,
  type: {
    type: String,
    required: false,
    default: 'text'
  },
  value: String,
})

const emit = defineEmits(['update:value'])

function emitValue(event) {
  const target = event.target
  emit("update:value", target.value);
}

</script>

<style scoped>
.input {
  display: flex;
  flex-direction: column;
}

.input__label {
  font-size: 16px;
  margin-bottom: 5px;
}
.input__input {
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #646464;
}
</style>
