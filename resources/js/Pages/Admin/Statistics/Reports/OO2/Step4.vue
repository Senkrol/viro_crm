<script setup>

import SubmitButtonShort from '@/Components/Form/SubmitButtonShort.vue';

import { useForm, } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps({
  stepData: Object,
});

let stepData = props.stepData ? props.stepData : [];
const form = useForm({
  editableCells: [],
})

let rows = [
  { 'number': '1', 'title': '1 - 4 классы' },
  { 'number': '2', 'title': '5 - 9 классы' },
  { 'number': '3', 'title': '10 - 11 (12) классы' },
];

const summColumn3 = ref(stepData.find(option => option.cell === '4_3') ? stepData.find(option => option.cell === '4_3').val : 0);
const summColumn4 = ref(stepData.find(option => option.cell === '4_4') ? stepData.find(option => option.cell === '4_4').val : 0);

const collsSum = (row) => {
  if (row == 3) {
    summColumn3.value = +document.getElementById("1_3").innerHTML + +document.getElementById("2_3").innerHTML + +document.getElementById("3_3").innerHTML;
  }
  if (row == 4) {
    summColumn4.value = +document.getElementById("1_4").innerHTML + +document.getElementById("2_4").innerHTML + +document.getElementById("3_4").innerHTML;
  }
}

const submit = () => {
  form.editableCells = [];
  document.querySelectorAll('.editable_cells').forEach(el => {
    form.editableCells.push({ 'cell': el.getAttribute('id'), 'val': el.innerHTML.replace(/&(nbsp|amp|quot|lt|gt);/g, " ").trim() })
  });

  form.post(route('admin.statistics.report.oo2.step4'), {
    // onError: () => form.reset("title"),
  });

}

</script>

<template>

  <div class="flex justify-between align-top">
    <div>
      <p>Раздел 1. Имущество организации (на конец отчетного года)</p>
      <p>1.3. Перевозка обучающихся, проживающих в отдаленных районах</p>
      <p>Код по ОКЕИ: единица – 642, человек – 792, место – 698</p>
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
          <td>№ строки</td>
          <td class="text-center">Численность обучающихся, нуждающихся в подвозе в организацию и (или) обратно</td>
          <td class="text-center">в том числе охвачено подвозом</td>
        </tr>
        <tr>
          <td v-for="i in 4" :key="i" class="text-center">{{ i }}</td>
        </tr>

        <tr v-for="row in rows" :key="row.number">
          <td v-html="row.title"></td>
          <td class="text-center">{{ row.number }}</td>
          <td contenteditable="true" :id="row.number + '_3'" @input='collsSum(3)' class="editable_cells bg-slate-300">
            {{ stepData.find(option => option.cell === row.number + '_3') ?
              stepData.find(option => option.cell === row.number + '_3').val : '' }}
          </td>
          <td contenteditable="true" :id="row.number + '_4'" @input='collsSum(4)' class="editable_cells bg-slate-300">
            {{ stepData.find(option => option.cell === row.number + '_4') ?
              stepData.find(option => option.cell === row.number + '_4').val : '' }}
          </td>
        </tr>
        <tr>
          <td>Всего (сумма строк 01 - 03)</td>
          <td class="text-center">4</td>
          <td :id="'4_3'" class="editable_cells">{{ summColumn3 }}</td>
          <td :id="'4_4'" class="editable_cells">{{ summColumn4 }}</td>
        </tr>
        <tr>
          <td>Справка 3. Число автотранспортных средств, предназначенных для перевозки обучающихся (ед)</td>
          <td class="text-center">5</td>
          <td contenteditable="true" :id="'5_3'" class="editable_cells bg-slate-300">
            {{ stepData.find(option => option.cell === '5_3') ?
              stepData.find(option => option.cell === '5_3').val : '' }}
          </td>
          <td></td>
        </tr>
        <tr>
          <td>в них пассажирских мест (мест)</td>
          <td class="text-center">6</td>
          <td contenteditable="true" :id="'6_3'" class="editable_cells bg-slate-300">
            {{ stepData.find(option => option.cell === '6_3') ?
              stepData.find(option => option.cell === '6_3').val : '' }}
          </td>
          <td></td>
        </tr>
        <tr>
          <td>Число автотранспортных средств, предназначенных для хозяйственных нужд (ед)</td>
          <td class="text-center">7</td>
          <td contenteditable="true" :id="'7_3'" class="editable_cells bg-slate-300">
            {{ stepData.find(option => option.cell === '7_3') ?
              stepData.find(option => option.cell === '7_3').val : '' }}
          </td>
          <td></td>
        </tr>

      </tbody>
    </table>
  </div>
</template>