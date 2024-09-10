<script setup>
import { ref } from 'vue';

const model = defineModel({
  type: [String, Number],
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
  autocomplete:{
    type: String,
    default: "Off"
  },
  type:{
    type: String,
    default: "text"
  }

  
});


const input = ref(null);

const lel = "dd";
</script>

<template>
  <div class="flex flex-col my-2">

    <label :for="id" class="block font-medium text-sm text-gray-700">{{ title }}</label>

    <input :id="id" :type="type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
      v-model="model" :autocomplete="autocomplete" ref="input" />

    <p v-show="message" class="text-sm text-red-600">{{ message }}</p>

  </div>

</template>
