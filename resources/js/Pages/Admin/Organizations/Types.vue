<template>
  <AdminLayout>

    <PageHeader :title="'Типы'">

      <Link :href="route('admin.organizations.type.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>

    </PageHeader>

    <Section>

      <GridTableHeader :headers="['ID', 'Тип']" />
      <GridTableLine v-for="type in types" :key="type.id" :values="[
        ['ID', type.id],
        ['Тип', type.type_title],
      ]" :routeEdit="route('admin.organizations.type.edit', { type: type.id })" />

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
  types: Object
});



</script>