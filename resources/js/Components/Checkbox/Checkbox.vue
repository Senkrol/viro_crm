<script setup>

/*
базовое использование 

  {{ checkboxActive }}
  <Checkbox label="Шабланка чекбокса" id="checkboxActive" name="checkboxActive" value="99"
  v-model:checked="checkboxActive" />
          
const checkboxActive = ref(true);
*/
const emits = defineEmits(['update:checked', 'updateCheckboxGroup'])
const props = defineProps({
  name: {
    type: [String, Number],
    default: ''
  },
  id: {
    type: [String, Number],
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
  type: {
    type: String,
    default: 'checkbox'
  }
})

const handleClick = (event) => {
  if (props.group) {
    emits('updateCheckboxGroup', { optionId: props.id, checked: event.target.checked })
  } else {
    emits('update:checked', event.target.checked)
  }
}
</script>

<template>
  <div class="flex items-center">
    <input
      class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
      type="checkbox" :name="name" :id="id" :value="value" :checked="checked" :disabled="disabled"
      @input="handleClick($event)">
    <label :for="id" class="cursor-pointer ms-2 text-sm text-gray-900">{{ label }}</label>

  </div>


</template>