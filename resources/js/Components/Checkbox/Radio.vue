<script setup>
const emits = defineEmits(['update:value'])
const props = defineProps({
  name: {
    type: String,
    default: ''
  },
  id: {
    type: String,
    default: ''
  },
  value: {
    type: String,
    default: ''
  },
  label: {
    type: String,
    default: ''
  },
  checked: {
    type: Boolean,
    default: false
  },
  disabled: {
    type: Boolean,
    default: false
  },
  group: {
    type: Boolean,
    default: false
  },
})

const handleClick = (event) => {
  emits('update:value', event.target.value)
}
</script>

<template>
  <div class="flex items-center gap-2">
    <input type="radio" class="cursor-pointer" :name="name" :id="id" :value="value" :checked="checked" :disabled="disabled"
      @input="handleClick($event)">
    <label :for="id" class="cursor-pointer">{{ label }}</label>
  </div>
</template>
