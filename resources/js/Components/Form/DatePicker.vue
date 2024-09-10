<script setup>
import { ref } from 'vue';

const model = defineModel({
  type: [String, Date],
  required: true,
});

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  id: {
    type: String,
    required: true,
  },
  message: {
    type: String,
  },
});

</script>

<template>
  <div class="flex flex-col my-2">

    <label :for="id" class="block font-medium text-sm text-gray-700">{{ title }}</label>

    <VueDatePicker :id="id" v-model="model" class="mt-1 block w-full" :enable-time-picker="false" locale="ru"
      auto-apply></VueDatePicker>

    <p v-show="message" class="text-sm text-red-600">{{ message }}</p>
  </div>
</template>
