<template>
  <AdminLayout>

    <PageHeader :title="'Руководители организаций'">

      <Link :href="route('admin.statistics.organizations.admin.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>

    </PageHeader>

    <div class="mb-2 grid gap-4" :class="(adminType === 1)? 'grid-cols-2': 'grid-cols-1'" >

      <FormSelectInput v-if="adminType === 1" :title="'Округ/Район'" :id="'district'" v-model="district" :options="props.districts"
        :trackBy="'id'" :labelBy="'district_title'">
      </FormSelectInput>

      <FormTextInput :type="'search'" :title="'Поиск'" id="search" v-model="search" />

    </div>

    <Section>

      <GridTableHeader :headers="['Фамилия', 'Имя', 'Отчество', 'Организация']" />
      <GridTableLine v-for="organizationAdmin in organizationsAdmins.data" :key="organizationAdmin.id" :values="[
        ['ID', organizationAdmin.surname],
        ['ID', organizationAdmin.name],
        ['ID', organizationAdmin.patronymic],
        ['ID', organizationAdmin.short_name],

      ]"
        :routeEdit="route('admin.statistics.organizations.admin.edit', { organizationAdmin: organizationAdmin.id })" />

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

import FormSelectInput from '@/Components/Form/SelectInput.vue';
import FormTextInput from '@/Components/Form/TextInput.vue';
import { useForm, Link, router, usePage } from '@inertiajs/vue3';
import { debounce } from "lodash";
import { ref, watch, onMounted } from "vue";


const adminType = usePage().props.auth.user.admin_type;

const props = defineProps({
  organizationsAdmins: Object,
  districts: Object,
  searchDistrict: Number,
  searchTerm: String
});

const search = ref(props.searchTerm ? props.searchTerm : '');
const district = ref(props.searchDistrict ? props.districts.find(option => option.id === props.searchDistrict) : []);

watch(
  search, debounce(() => filter(), 800)
);

watch(() => district.value, () => filter())


function filter() {

  let data = {
    search: search.value,
    district: district.value ? district.value.id : '',
  }

  router.get(route('admin.statistics.organizations.admins.index'), data)
}
</script>