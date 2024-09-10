<script setup>
import Checkbox from '@/Components/Checkbox/Checkbox.vue'

const emit = defineEmits(['update:value'])
const props = defineProps({
  groupTitle: {
    type: String
  },
  value: {
    type: Array,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  options: {
    type: Array,
    required: true,
    validator: (value) => {
      const hasNameKey = value.every((option) => Object.keys(option).includes('name'))
      const hasIdKey = value.every((option) => Object.keys(option).includes('id'))
      return hasNameKey && hasIdKey
    }
  }
})

const check = (params) => {
  let updateValue = [...props.value]
  if (params.checked) {
    updateValue.push(params.optionId)
  } else {
    updateValue.splice(updateValue.indexOf(params.optionId), 1)
  }
  emit('update:value', updateValue)
}
</script>

<template>
  <h2 v-if="groupTitle" class="text-lg font-medium mb-2">{{ groupTitle }}</h2>
  <div v-for="option in options" :key="option.id">
    <checkbox :label="option.name" :id="option.id" :name="name" :value="option.name"
      :checked="value.includes(option.id)" group @updateCheckboxGroup="check" />
  </div>
</template>