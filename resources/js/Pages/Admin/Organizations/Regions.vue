<template>
  <AdminLayout>

    <PageHeader :title="'Регионы'">

      <Link :href="route('admin.organizations.region.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>
      
    </PageHeader>

    <Section>
  
        <GridTableHeader
          :headers="['ID', 'Код региона', 'Наименование']" />
        <GridTableLine v-for="region in regions.data" :key="region.id" :values="[
          ['ID', region.id],
          ['Код региона', region.region_number],
          ['Наименование', region.region_title],
        ]" :routeEdit="route('admin.organizations.region.edit', { region: region.id })" />
    
    </Section>

    <PaginationLinks :paginator="props.regions"></PaginationLinks>
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
  regions: Object
});



</script>