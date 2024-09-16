<template>
  <AdminLayout>

    <PageHeader :title="'Администраторы'">

      <Link :href="route('admin.administration.admin.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>
    </PageHeader>

    <Section class="mb-2">
        <div>
          <input type="search" ref="searchFocus" placeholder="Поиск" v-model="search">
        </div>
    </Section>

    <Section>
   
      <GridTableHeader :headers="['ID', 'Фамилия', 'Имя', 'Отчество', 'Email']" />
      <GridTableLine v-for="admin in admins.data" :key="admin.id" :values="[
        ['ID', admin.id],
        ['Фамилия', admin.surname],
        ['Имя', admin.name],
        ['Отчество', admin.patronymic],
        ['Email', admin.email],
      ]" :routeEdit="route('admin.administration.admin.edit', { admin: admin.id })" />

    </Section>


    <div>
      <PaginationLinks :paginator="admins" />
    </div>
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
import { debounce } from "lodash";
import { ref, watch,onMounted  } from "vue";


const props = defineProps({
  admins: Object,
  searchTerm: String,
});

const search = props.searchTerm ? ref(props.searchTerm) : ref('');


watch(
  search, debounce((q) => router.get(route('admin.administration.admins.index'), { search: q }), 500)
);

const searchFocus = ref(null)
onMounted(() => {
  searchFocus.value.focus()
})
</script>