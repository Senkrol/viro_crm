<template>
  <AdminLayout>

    <PageHeader :title="'Округа/Районы'">

      <Link :href="route('admin.organizations.district.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>
      
    </PageHeader>

    <Section>

        <GridTableHeader
          :headers="['ID', 'Наименование','Регион']" />
        <GridTableLine v-for="district in districts.data" :key="district.id" :values="[
          ['ID', district.id],
          ['Наименование', district.district_title],
          ['Регион', district.region_title],
        ]" :routeEdit="route('admin.organizations.district.edit', { district: district.id })" />
    
    </Section>

    <PaginationLinks :paginator="props.districts"></PaginationLinks>
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
  districts: Object
});



</script>