<template>
  <AdminLayout>

    <PageHeader :title="'Отделы'">

      <Link :href="route('admin.administration.department.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>

    </PageHeader>

    <Section>

      <GridTableHeader :headers="['ID', 'Отдел']" />
      <GridTableLine v-for="department in departments" :key="department.id" :values="[
        ['ID', department.id],
        ['Отдел', department.title],
      ]" :routeEdit="route('admin.administration.department.edit', { department: department.id })" />

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
  departments: Object
});

</script>