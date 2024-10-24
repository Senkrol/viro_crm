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

  form.post(route('admin.statistics.report.oo2.step1'), {
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
          <td rowspan="2">№ строки</td>
          <td rowspan="2">Оборудовано водопроводом</td>
          <td rowspan="2">Оборудовано водоотведением (канализацией)</td>
          <td rowspan="2">Оборудовано центральным отоплением</td>
          <td rowspan="2">Оборудовано системой видеонаблюдения</td>
          <td rowspan="2">Требует капитального ремонта</td>
          <td rowspan="2">Находится в аварийном состоянии</td>
          <td rowspan="2">Имеет ограждение территории</td>
          <td rowspan="2">Имеет охрану</td>
          <td rowspan="2">Оборудовано автоматической пожарной сигнализацией</td>
          <td rowspan="2">Имеет дымовые извещатели</td>
          <td rowspan="2">Имеет пожарные краны и рукава</td>
          <td rowspan="2">Оборудовано кнопкой тревожной сигнализации</td>
          <td rowspan="2">Доступно для маломобильных групп населения</td>
          <td rowspan="2">Всего</td>
          <td colspan="9">из гр. 16: число зданий с максимальной скоростью доступа к Интернету</td>
        </tr>
        <tr>
          <td style="min-width: 120px;">ниже 256 Кбит/сек</td>
          <td style="min-width: 120px;">256 - 511 Кбит/сек</td>
          <td style="min-width: 120px;">512 Кбит/сек - 999 Кбит/сек</td>
          <td style="min-width: 120px;">1.0 - 1.9 Мбит/сек</td>
          <td style="min-width: 120px;">2.0 - 29.9 Мбит/сек</td>
          <td style="min-width: 120px;">30.0 - 49.9 Мбит/сек</td>
          <td style="min-width: 120px;">50.0 - 99.9 Мбит/сек</td>
          <td style="min-width: 120px;">100 Мбит/сек и выше</td>
        </tr>
        <tr>
          <td v-for="i in 24" :key="i" class="text-center">{{ i }}</td>
        </tr>
        <tr>
          <td>Здания организации</td>
          <td class="text-center">01</td>
          <td v-for="i in 22" :key="i" contenteditable="true" :id="'1_' + (i + 2)" class="editable_cells bg-slate-300">
            {{ props.stepData.find(option => option.cell === '1_' + (i + 2)) ?
              props.stepData.find(option => option.cell === '1_' + (i + 2)).val : '' }}
          </td>
        </tr>
        <tr>
          <td>Кроме того, часть здания (помещения)</td>
          <td class="text-center">02</td>
          <td v-for="i in 22" :key="i" contenteditable="true" :id="'2_' + (i + 2)" class="editable_cells bg-slate-300">
            {{ props.stepData.find(option => option.cell === '2_' + (i + 2)) ?
              props.stepData.find(option => option.cell === '2_' + (i + 2)).val : '' }}
          </td>
        </tr>
        <tr>
          <td>"Справка 1.<br>Число огнетушителей (ед)"</td>
          <td>03</td>
          <td contenteditable="true" :id="'3_3'" class="editable_cells bg-slate-300">
            {{ props.stepData.find(option => option.cell === '3_3') ?
              props.stepData.find(option => option.cell === '3_3').val : '' }}
          </td>
          <td v-for="i in 21" :key="i"></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>