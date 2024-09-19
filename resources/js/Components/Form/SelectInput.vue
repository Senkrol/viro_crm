<script setup>

const model = defineModel({
  type: Object,
  default: []
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
  options: {
    type: Object,
    required: true,
  },
  trackBy: {
    type: String,
    required: true,
  },
  labelBy: {
    type: String,
    required: true,
  },
});

// хорошо бы узнать как использовать именованные слоты 
// https://vuejs.org/guide/components/slots.html
</script>

<template>
  <div class="flex flex-col my-2 shadow-sm">

    <label :for="id" class="block font-medium text-sm text-gray-700">{{ title }}</label>

    <vue-multiselect :id="id" v-model="model" :options="options" :track-by="trackBy" :label="labelBy" placeholder=""
      select-label="Выбрать" selected-label="Выбрано" noRecords="sdasd"  deselect-label="Убрать">
      <template v-slot:noResult><span>Нет результатов</span></template>
      <template v-slot:noOptions><span>Нет результатов</span></template>
    </vue-multiselect>

    <p v-show="message" class="text-sm text-red-600">{{ message }}</p>

  </div>

</template>
