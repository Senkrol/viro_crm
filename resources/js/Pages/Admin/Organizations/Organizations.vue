<template>
  <AdminLayout>

    <PageHeader :title="'Организации'">

      <Link :href="route('admin.organizations.organization.create')"
        class="flex justify-center rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      Создать
      </Link>

    </PageHeader>

    <Section class="mb-2 grid grid-cols-3 gap-4">

      <FormSelectInput :title="'Регион'" :id="'organization_region_id'" v-model="region" :options="props.regions"
        :trackBy="'id'" :labelBy="'region_title'">
      </FormSelectInput>

      <FormSelectInput :title="'Округ/Район'" :id="'district'" v-model="district" :options="optionsDistrict"
        :trackBy="'id'" :labelBy="'district_title'">
      </FormSelectInput>

      <FormTextInput :type="'search'" :title="'Поиск'" id="search" v-model="search" />


    </Section>

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
import FormSelectInput from '@/Components/Form/SelectInput.vue';
import FormTextInput from '@/Components/Form/TextInput.vue';
import { useForm, Link, router } from '@inertiajs/vue3';
import { debounce } from "lodash";
import { ref, watch, onMounted } from "vue";

const props = defineProps({
  organizations: Object,
  regions: Object,
  districts: Object,
  searchTerm: String,
  searchRegion: Number,
  searchDistrict: Number,
});


const search = ref(props.searchTerm ? props.searchTerm : '');
const region = ref(props.searchRegion ? props.regions.find(option => option.id === props.searchRegion) : []);
const district = ref(props.searchDistrict ? props.districts.find(option => option.id === props.searchDistrict) : []);

let optionsDistrict = props.districts;

watch(
  search, debounce(() => filter(), 500)
);


watch(
  () => region.value,
  () => {
    district.value = [];
    
    if (region.value) {
      axios
        .post(route('admin.organizations.districts.getlist', { id: region.value }))
        .then((response) => {
          optionsDistrict = response.data;
        })
    } else {
      optionsDistrict = [];
    }
  }
)

watch(
  () => district.value,
  () => { filter(); }
)


function filter() {

  let data = {
    search: search.value,
    region: region.value ? region.value.id : '',
    district: district.value ? district.value.id : '',
  }

  router.get(route('admin.organizations.organizations.index'), data)
}
</script>