<template>
  <AdminLayout>
    <ReportLayout :title="'Отчет: ОО-2'" :links="links" :activeStep="props.step">

      <p v-if="!props.step">Привет работяга, ты в редакторе отчета ОО-2</p>
      <Step1 v-if="props.step == 1"></Step1>
      <Step2 v-if="props.step == 2"></Step2>
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
  step: String
});

const links = ref([
  { part: 1, title: '1.1. Характеристика здания (зданий)' },
  { part: 2, title: '1.1.1 Характеристика материала стен здания (зданий)' },
  { part: 3, title: '1.2. Сведения о помещениях' },
  { part: 4, title: '1.3. Перевозка обучающихся, проживающих в отдаленных районах' },
  { part: 5, title: '1.4. Охват обучающихся горячим питанием (на конец отчетного года)' },
  { part: 6, title: '1.5. Наличие и использование площадей' },
  { part: 7, title: '1.6. Деятельность организации' },
  { part: 8, title: '2.1. Количество персональных компьютеров и информационного оборудования (на конец отчетного года)' },
  
]);


</script>