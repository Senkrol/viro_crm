<script setup>

import SubmitButtonShort from '@/Components/Form/SubmitButtonShort.vue';

import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  stepData: Object,
});

let stepData = props.stepData ? props.stepData : [];
const form = useForm({
  editableCells: [],
})

let rows = [
  { 'number': '1', 'title': 'Актовый зал' },
  { 'number': '2', 'title': 'Спортивный зал' },
  { 'number': '3', 'title': 'Закрытый плавательный бассейн' },
  { 'number': '4', 'title': 'Столовая или зал для приема пищи' },
  { 'number': '5', 'title': 'Оборудованные кабинеты:<br>основ информатики и вычислительной техники' },
  { 'number': '6', 'title': 'физики' },
  { 'number': '7', 'title': 'химии' },
  { 'number': '8', 'title': 'биологии' },
  { 'number': '9', 'title': 'географии' },
  { 'number': '10', 'title': 'для внеурочной деятельности' },
  { 'number': '11', 'title': 'основ безопасности и жизнедеятельности' },
  { 'number': '12', 'title': 'иностранного языка' },
  { 'number': '13', 'title': 'Мастерские для трудового обучения' },
  { 'number': '14', 'title': 'Кабинет домоводства' },
  { 'number': '15', 'title': 'Музей' },
  { 'number': '16', 'title': 'Учебно-опытный земельный участок' },
  { 'number': '17', 'title': 'Лекционная аудитория' },
  { 'number': '18', 'title': 'Медицинский пункт (кабинет)' },
  { 'number': '19', 'title': 'Логопедический пункт (кабинет)' },
  { 'number': '20', 'title': 'Кабинет учителя-дефектолога' },
  { 'number': '21', 'title': 'Кабинет педагога-психолога' },
  { 'number': '22', 'title': 'Оборудованная территория для реализации раздела «Легкая атлетика» программы по физической культуре' },
  { 'number': '23', 'title': 'Справка 2.<br>Количество классных комнат (кабинетов) (ед)' },
  { 'number': '24', 'title': 'из них  оборудованы:<br>стационарными интерактивными досками (ед)' },
  { 'number': '25', 'title': 'мультимедийными проекторами (ед)' },
  { 'number': '26', 'title': 'Количество мест в кабинетах основ информатики  и вычислительной техники (из стр.05) (мест)' },
  { 'number': '27', 'title': 'Наличие мест для личной гигиены, санитарных узлов (туалетов), проставить код: да – 1, нет – 0' },
];
const submit = () => {
  form.editableCells = [];
  document.querySelectorAll('.editable_cells').forEach(el => {
    form.editableCells.push({ 'cell': el.getAttribute('id'), 'val': el.innerHTML.replace(/&(nbsp|amp|quot|lt|gt);/g, " ").trim() })
  });

  form.post(route('admin.statistics.report.oo2.step3'), {
    // onError: () => form.reset("title"),
  });

}

</script>

<template>
  <div class="flex justify-between align-top">
    <div>
      <p>Раздел 1. Имущество организации (на конец отчетного года)</p>
      <p>1.2. Сведения о помещениях</p>
      <p>Код по ОКЕИ: единица – 642, место – 698</p>
    </div>
    <form @submit.prevent="submit">
      <SubmitButtonShort :disabled="form.processing">Сохранить</SubmitButtonShort>
    </form>
  </div>
  <div v-if="$page.props.flash.errorSpot" class="p-4 bg-red-400 mb-4 rounded-md w-full">
    {{ $page.props.flash.errorSpot }}
  </div>
  <div v-if="$page.props.flash.successSpot" class="p-4 bg-lime-400 mb-4 rounded-md w-full">
    {{ $page.props.flash.successSpot }}
  </div>

  <div class="flex flex-1 flex-col overflow-auto">
    <table>
      <tbody>
        <tr>
          <td>Наименование показателей</td>
          <td>№</td>
          <td class="text-center">Наличие в организации код: да – 1, нет – 0</td>
          <td class="text-center">из них (из графы 3) использование помещений (объектов) сторонних организаций (по
            договору аренды или другим соглашениям) код: да – 1, нет – 0</td>
        </tr>
        <tr>
          <td v-for="i in 4" :key="i" class="text-center">{{ i }}</td>
        </tr>

        <tr v-for="row in rows" :key="row.number">
          <td v-html="row.title"></td>
          <td class="text-center">{{ row.number }}</td>
          <td contenteditable="true" :id="row.number + '_3'" class="editable_cells bg-slate-300">
            {{ stepData.find(option => option.cell === row.number + '_3') ?
              stepData.find(option => option.cell === row.number + '_3').val : '' }}
          </td>
          <td v-if="row.number < 23" contenteditable="true" :id="row.number + '_4'" class="editable_cells bg-slate-300">
            {{ stepData.find(option => option.cell === row.number + '_4') ?
              stepData.find(option => option.cell === row.number + '_4').val : '' }}
          </td>
          <td v-else></td>
        </tr>


      </tbody>
    </table>
  </div>
</template>