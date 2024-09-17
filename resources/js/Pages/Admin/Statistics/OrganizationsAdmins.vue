<template>
  <AdminLayout>

    <PageHeader :title="'Руководители организаций'">

      <Link :href="route('admin.statistics.organization.admin.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>
      
    </PageHeader>

    <Section>

        <GridTableHeader
          :headers="['Фамилия','Имя','Отчество','Организация']" />
        <GridTableLine v-for="organizationAdmin in organizationsAdmins.data" :key="organizationAdmin.id" :values="[
          ['ID', organizationAdmin.surname],
          ['ID', organizationAdmin.name],
          ['ID', organizationAdmin.patronymic],
          ['ID', organizationAdmin.short_name],
          
        ]" :routeEdit="route('admin.statistics.organization.admin.edit', { organizationAdmin: organizationAdmin.id })" />
    
    </Section>

    <PaginationLinks :paginator="props.organizationsAdmins"></PaginationLinks>
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
  organizationsAdmins: Object
});



</script>