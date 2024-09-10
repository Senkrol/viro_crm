<template>
  <AdminLayout>

    <PageHeader :title="'Региональные координаторы'">

      <Link :href="route('admin.statistics.regional.admin.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>
      
    </PageHeader>

    <Section>

        <GridTableHeader
          :headers="['ID', 'Наименование','Регион']" />
        <GridTableLine v-for="regionalAdmin in regionalAdmins.data" :key="regionalAdmin.id" :values="[
          ['ID', regionalAdmin.id],
          ['Наименование', regionalAdmin.district_title],
          ['Регион', regionalAdmin.region_title],
        ]" :routeEdit="route('admin.statistics.regional.admins.edit', { district: district.id })" />
    
    </Section>

    <PaginationLinks :paginator="props.regionalAdmins"></PaginationLinks>
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
  regionalAdmins: Object
});



</script>