<template>
  <AdminLayout>
    <ReportLayout :title="'Отчет: ОО-2'" :links="links" :activeStep="props.step">
      <div v-if="!props.step">
        <p>Форма заполнения отчета ОО-2</p>
        <p>Выберите интересующий вас раздел</p>
      </div>
      {{  props.report }}
      <Step1 v-if="props.step == 1" :stepData="props.report ? JSON.parse(props.report['step1']) : []"></Step1>
      <Step2 v-if="props.step == 2" :stepData="props.report ? JSON.parse(props.report['step2']) : []"></Step2>
      <Step3 v-if="props.step == 3"></Step3>
      <Step4 v-if="props.step == 4"></Step4>
    </ReportLayout>
  </AdminLayout>
</template>


<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

import ReportLayout from '@/Pages/Admin/Statistics/Reports/OO2/Layout.vue';

import FormHeader from '@/Components/Form/Header.vue';
import FormTextInput from '@/Components/Form/TextInput.vue';

import SubmitButton from '@/Components/Form/SubmitButton.vue'

import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';


import Step1 from '@/Pages/Admin/Statistics/Reports/OO2/Step1.vue';
import Step2 from '@/Pages/Admin/Statistics/Reports/OO2/Step2.vue';
import Step3 from '@/Pages/Admin/Statistics/Reports/OO2/Step3.vue';
import Step4 from '@/Pages/Admin/Statistics/Reports/OO2/Step4.vue';

const props = defineProps({
  step: String,
  report: Object,
});

const links = ref([
  { part: 1, title: 'Раздел 1.1.' },
  { part: 2, title: 'Раздел 1.1.1' },
  { part: 3, title: 'Раздел 1.2.' },
  { part: 4, title: 'Раздел 1.3.' },
  { part: 5, title: 'Раздел 1.4.' },
  { part: 6, title: 'Раздел 1.5.' },
  { part: 7, title: 'Раздел 1.6.' },
  { part: 8, title: 'Раздел 2.1.' },
  { part: 9, title: 'Раздел 2.2.' },
  { part: 10, title: 'Раздел 2.3.' },
  { part: 11, title: 'Раздел 2.4.' },
  { part: 12, title: 'Раздел 2.5.' },
  { part: 13, title: 'Раздел 2.6.' },
  { part: 14, title: 'Раздел 2.7.' },
  { part: 15, title: 'Раздел 3.1.' },
  { part: 16, title: 'Раздел 3.2.' },
  { part: 17, title: 'Раздел 3.3.' },
  { part: 18, title: 'Раздел 3.4.' },
  { part: 19, title: 'Раздел 3.5.' },
  { part: 20, title: 'Раздел 3.6.' },
  { part: 21, title: 'Завершение' },
]);


</script>