<template>
  <AdminLayout>
    
    <PageHeader :title="'Электронные цифровые подписи'">
      <button
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90"
        @click="download('hello world.xlsx')">Выгрузить</button>

      <Link :href="route('admin.digital-signatures.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>
    </PageHeader>

    <Section>
   
        <GridTableHeader
          :headers="['ID', 'Серийный номер', 'Дата выдачи', 'Дата окончания', 'Порядковый номер', 'ИС', 'Работяга']" />
        <GridTableLine v-for="digitalSignature in digitalSignatures" :key="digitalSignature.id" :values="[
          ['ID', digitalSignature.id],
          ['Серийный номер', digitalSignature.serial_number],
          ['Дата выдачи', digitalSignature.date_start],
          ['Дата окончания', digitalSignature.date_end],
          ['Порядковый номер', digitalSignature.order_number],
          ['ИС', digitalSignature.title],
          ['Работяга', digitalSignature.name]]" :routeEdit="route('admin.digital-signatures.edit', { digitalSignature: digitalSignature.id })" />
    
    </Section>


  </AdminLayout>

</template>


<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import PageHeader from '@/Components/Page/PageHeader.vue';
import Section from '@/Components/Page/Section.vue';
import GridTableHeader from '@/Components/GridTable/GridTableHeader.vue';
import GridTableLine from '@/Components/GridTable/GridTableLine.vue';

import { Link } from '@inertiajs/vue3';

function download(file) {
  const url = route('admin.digital-signatures.report', { year: 2024, month: 1, some: "что угодно еще" })
  window.location.href = url
}

const props = defineProps({
  digitalSignatures: Object
});



</script>