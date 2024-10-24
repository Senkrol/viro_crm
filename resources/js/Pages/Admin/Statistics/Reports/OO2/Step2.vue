<script setup>

import SubmitButtonShort from '@/Components/Form/SubmitButtonShort.vue';

import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  stepData: Object,
});

const form = useForm({
  editableCells: [],
})

const submit = () => {
  form.editableCells = [];
  document.querySelectorAll('.editable_cells').forEach(el => {
    form.editableCells.push({ 'cell': el.getAttribute('id'), 'val': el.innerHTML.replace(/&(nbsp|amp|quot|lt|gt);/g, " ").trim() })
  });

  form.post(route('admin.statistics.report.oo2.step2'), {
    // onError: () => form.reset("title"),
  });

}

</script>

<template>
  <div class="flex justify-between align-top">
    <div>
      <p>Раздел 1. Имущество организации (на конец отчетного года)</p>
      <p>1.1. Характеристика здания (зданий)</p>
      <p>Код по ОКЕИ: единица – 642</p>
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
          <td rowspan="2">Наименование показателей</td>
          <td rowspan="2">№</td>
          <td rowspan="2" class="text-center">Год первоначального ввода в эксплуатацию</td>
          <td rowspan="2" class="text-center">Год последнего капитального ремонта</td>
          <td colspan="8" class="text-center">Характеристика материала стен здания</td>
        </tr>
        <tr>
          <td>каменные</td>
          <td>кирпичные</td>
          <td>панельные</td>
          <td>блочные</td>
          <td>деревянные</td>
          <td>монолитные</td>
          <td>смешанные</td>
          <td class="text-center">из прочих стеновых материалов</td>
        </tr>
        <tr>
          <td v-for="i in 12" :key="i" class="text-center">{{ i }}</td>
        </tr>
        <tr v-for="j in 30" :key="j">
          <td>Здание {{ j }}</td>
          <td class="text-center">{{ j }}</td>
          <td v-for="i in 10" :key="i" contenteditable="true" :id="j + '_' + (i + 2)"
            class="editable_cells bg-slate-300">
            {{ props.stepData.find(option => option.cell === j + '_' + (i + 2)) ?
              props.stepData.find(option => option.cell === j + '_' + (i + 2)).val : '' }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>