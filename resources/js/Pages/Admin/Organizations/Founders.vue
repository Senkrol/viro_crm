<template>
  <AdminLayout>

    <PageHeader :title="'Регионы'">

      <Link :href="route('admin.organizations.founder.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>

    </PageHeader>

    <Section>

      <GridTableHeader :headers="['ID', 'Учредитель']" />
      <GridTableLine v-for="founder in founders" :key="founder.id" :values="[
        ['ID', founder.id],
        ['Учредитель', founder.founder_title],
      ]" :routeEdit="route('admin.organizations.founder.edit', { founder: founder.id })" />

    </Section>

  </AdminLayout>

</template>


<script setup>


import AdminLayout from '@/Layouts/AdminLayout.vue';

import PageHeader from '@/Components/Page/PageHeader.vue';
import Section from '@/Components/Page/Section.vue';
import GridTableHeader from '@/Components/GridTable/GridTableHeader.vue';
import GridTableLine from '@/Components/GridTable/GridTableLine.vue';

import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  founders: Object
});



</script>