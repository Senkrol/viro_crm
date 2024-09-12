<template>
  <AdminLayout>

    <PageHeader :title="'Муниципальные координаторы'">

      <Link :href="route('admin.statistics.municipal.admin.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>
      
    </PageHeader>

    <Section>

        <GridTableHeader
          :headers="['Фамилия','Имя','Отчество','Округ/Район']" />
        <GridTableLine v-for="municipalAdmin in municipalAdmins.data" :key="municipalAdmin.id" :values="[
          ['ID', municipalAdmin.surname],
          ['ID', municipalAdmin.name],
          ['ID', municipalAdmin.patronymic],
          ['ID', municipalAdmin.district_title],
          
        ]" :routeEdit="route('admin.statistics.municipal.admin.edit', { municipalAdmin: municipalAdmin.id })" />
    
    </Section>

    <PaginationLinks :paginator="props.municipalAdmins"></PaginationLinks>
  </AdminLayout>

</template>


<script setup>


import AdminLayout from '@/Layouts/AdminLayout.vue';

import PageHeader from '@/Components/Page/PageHeader.vue';
import Section from '@/Components/Page/Section.vue';
import GridTableHeader from '@/Components/GridTable/GridTableHeader.vue';
import GridTableLine from '@/Components/GridTable/GridTableLine.vue';

import PaginationLinks from '@/Components/Page/PaginationLinks.vue';

import { Link, router } from '@inertiajs/vue3';
const props = defineProps({
  municipalAdmins: Object
});



</script>