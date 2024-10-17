<script setup>
import { ref } from 'vue'

import SelectInput from '@/Components/Form/SelectInput.vue';

import CheckboxGroup from '@/Components/Checkbox/CheckboxGroup.vue';


import { useForm, router } from '@inertiajs/vue3';

const form = useForm({
  point1: false,
  chain2: false,
  chain3: false,
})
const selectedPossibilitys = ref([]);
// ref(props.admin ? form.possibilitys : []) как из базы достану так сразу
const steps = [
  { 'id': 's1_1', 'name': 'Оборудовано водопроводом' },
  { 'id': 's1_2', 'name': 'Оборудовано водоотведением (канализацией)' },
  { 'id': 's1_3', 'name': 'Оборудо-вано центральным отоплением' },
  { 'id': 's1_4', 'name': 'Оборудовано системой видеонаблюдения' },
  { 'id': 's1_5', 'name': 'Находится в аварийном состоянии' },
  { 'id': 's1_6', 'name': 'Имеет ограждение территории' },
  { 'id': 's1_7', 'name': 'Имеет охрану' },
  { 'id': 's1_8', 'name': 'Оборудовано автоматической пожарной сигнализацией' },
  { 'id': 's1_9', 'name': 'Имеет дымовые извещатели' },
  { 'id': 's1_10', 'name': 'Имеет пожарные краны и рукава' },
  { 'id': 's1_11', 'name': 'Оборудовано кнопкой тревожной сигнализации' },
  { 'id': 's1_12', 'name': 'Доступно для маломобильных групп населения' },
];

const ethernetSpeed = [
  {}
  ]
</script>

<template>

  <CheckboxGroup name="Administration" v-model:value="selectedPossibilitys" :options="steps" />
  <!--

  <p>Максимальной скорость доступа к Интернету</p>

  ниже 256 Кбит/сек
  256 - 511 Кбит/сек
  512 - 999 Кбит/сек
  1.0 - 1.9 Мбит/сек
  2.0 - 29.9 Мбит/сек
  30.0 - 49.9 Мбит/сек
  50.0 - 99.9 Мбит/сек
  100 Мбит/сек и выше

  число огнетушителей

-->

</template>