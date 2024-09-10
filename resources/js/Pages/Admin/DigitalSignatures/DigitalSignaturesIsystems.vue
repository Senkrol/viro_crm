<template>
  <AdminLayout>

    <PageHeader :title="'Информационные системы'">

      <Link :href="route('admin.digital-signatures.isystems.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>
      
    </PageHeader>

    <Section>
 
        <GridTableHeader :headers="['ID', 'Наименование']" />
        <GridTableLine v-for="isystem in isystems" :key="isystem.id" :values="[
          ['ID', isystem.id],
          ['Наименование', isystem.title]]" :routeEdit="route('admin.digital-signatures.isystems.edit', { isystem: isystem.id })" />
    
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
  isystems: Object
});


</script>