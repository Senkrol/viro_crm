<template>
  <AdminLayout>

    <PageHeader :title="'Организации'">

      <Link :href="route('admin.organizations.organization.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>

    </PageHeader>

    <Section>
      <GridTableHeader :headers="['Наименование', 'Регион', 'Область', 'ИНН']" />
      <GridTableLine v-for="organization in organizations.data" :key="organization.id" :values="[
        ['Наименование', organization.short_name],
        ['Регион', organization.region_title],
        ['Область', organization.district_title],
        ['ИНН', organization.inn],
      ]" :routeEdit="route('admin.organizations.organization.edit', { organization: organization.id })" />

    </Section>

    <PaginationLinks :paginator="props.organizations"></PaginationLinks>
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
  organizations: Object
});



</script>