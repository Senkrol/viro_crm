<template>
  <AdminLayout>
    <Head title="Организация"></Head>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Организация
        </FormHeader>

        <GridLines>
          <FormTextInput :title="'Наименование - краткое'" id="short_name" v-model="form.short_name"
            :message="form.errors.short_name" />
        </GridLines>
        <GridLines>
          <FormTextInput :title="'Наименование - полное'" id="full_name" v-model="form.full_name"
            :message="form.errors.full_name" />
        </GridLines>
        <GridLines :cols="5">
          <FormTextInput :title="'ОКПО'" id="okpo" v-model="form.okpo" :message="form.errors.okpo" />
          <FormTextInput :title="'ИНН'" id="inn" v-model="form.inn" :message="form.errors.inn" />
          <FormTextInput :title="'КПП'" id="kpp" v-model="form.kpp" :message="form.errors.kpp" />
          <FormTextInput :title="'ОГРН'" id="ogrn" v-model="form.ogrn" :message="form.errors.ogrn" />
          <FormTextInput :title="'Код ОУ'" id="code_OU" v-model="form.code_OU" :message="form.errors.code_OU" />
        </GridLines>

        <GridLines :cols="2">
          <FormSelectInput :title="'Регион'" :id="'organization_region_id'" v-model="form.organization_region_id"
            :message="form.errors.organization_region_id" :options="props.regions" :trackBy="'id'"
            :labelBy="'region_title'" />

          <FormSelectInput :title="'Округ/Район'" :id="'organization_district_id'"
            v-model="form.organization_district_id" :message="form.errors.organization_district_id"
            :options="optionsDistrict" :trackBy="'id'" :labelBy="'district_title'" />

        </GridLines>

        <GridLines :cols="3">
          <FormSelectInput :title="'Учредитель'" :id="'organization_founder_id'" v-model="form.organization_founder_id"
            :message="form.errors.organization_founder_id" :options="props.founders" :trackBy="'id'"
            :labelBy="'founder_title'" />

          <FormSelectInput :title="'Тип'" :id="'organization_type_id'" v-model="form.organization_type_id"
            :message="form.errors.organization_type_id" :options="props.types" :trackBy="'id'"
            :labelBy="'type_title'" />

          <FormSelectInput :title="'Город/Село'" :id="'village_city'" v-model="form.village_city"
            :message="form.errors.village_city" :options="optionsVillageCity" :trackBy="'id'" :labelBy="'title'" />
        </GridLines>

        <FormTextInput :title="'Почтовый адрес'" id="postal_address" v-model="form.postal_address"
          :message="form.errors.postal_address" />

        <GridLines :cols="3">
          <FormTextInput :title="'Фамилия руководителя'" id="director_surname" v-model="form.director_surname"
            :message="form.errors.director_surname" />

          <FormTextInput :title="'Имя руководителя'" id="director_name" v-model="form.director_name"
            :message="form.errors.director_name" />

          <FormTextInput :title="'Отчество руководителя'" id="director_patronymic" v-model="form.director_patronymic"
            :message="form.errors.director_patronymic" />
        </GridLines>


        <GridLines :cols="2">
          <FormTextInput :title="'Телефон'" id="org_phone" v-model="form.org_phone" :message="form.errors.org_phone" />
          <FormTextInput :title="'Почта'" id="org_email" v-model="form.org_email" :message="form.errors.org_email" />
        </GridLines>

        <div class="grid grid-cols-2 gap-2 mt-4">
          <DeleteButton @click.prevent="deleteEvent(organization.id)" :disabled="!props.organization">
            Удалить
          </DeleteButton>
          <SubmitButton :disabled="form.processing">
            Сохранить
          </SubmitButton>
        </div>

      </form>

    </Section>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Section from '@/Components/Page/Section.vue';

import FormHeader from '@/Components/Form/Header.vue';
import FormTextInput from '@/Components/Form/TextInput.vue';
import FormSelectInput from '@/Components/Form/SelectInput.vue';
import GridLines from '@/Components/Form/GridLines.vue'

import SubmitButton from '@/Components/Form/SubmitButton.vue'
import DeleteButton from '@/Components/Form/DeleteButton.vue'

import { Head, useForm, router } from '@inertiajs/vue3';
import axios from 'axios'
import { watch } from 'vue';

let props = defineProps({
  organization: Object,
  regions: Object,
  districts: Object,
  founders: Object,
  types: Object,
});

let optionsVillageCity = [{ 'id': 1, 'title': 'Город' }, { 'id': 2, 'title': 'Село' }];
let optionsDistrict = props.districts;

const form = useForm({

  id: props.organization ? props.organization.id : null,

  organization_region_id: props.organization ? props.regions.find(option => option.id === props.organization.organization_region_id) : [],
  organization_district_id: props.organization ? props.districts.find(option => option.id === props.organization.organization_district_id) : [],
  organization_founder_id: props.organization ? props.founders.find(option => option.id === props.organization.organization_founder_id) : [],
  organization_type_id: props.organization ? props.types.find(option => option.id === props.organization.organization_type_id) : [],

  code_OU: props.organization ? props.organization.code_OU : "",
  full_name: props.organization ? props.organization.full_name : "",
  short_name: props.organization ? props.organization.short_name : "",

  village_city: props.organization ? optionsVillageCity.find(option => option.id === props.organization.village_city) : [],

  postal_address: props.organization ? props.organization.postal_address : "",

  director_surname: props.organization ? props.organization.director_surname : "",
  director_name: props.organization ? props.organization.director_name : "",
  director_patronymic: props.organization ? props.organization.director_patronymic : "",

  okpo: props.organization ? props.organization.okpo : "",
  inn: props.organization ? props.organization.inn : "",
  kpp: props.organization ? props.organization.kpp : "",
  ogrn: props.organization ? props.organization.ogrn : "",

  org_phone: props.organization ? props.organization.org_phone : "",
  org_email: props.organization ? props.organization.org_email : "",


})


const submit = () => {
  form.post(route(form.id ? 'admin.organizations.organization.update' : 'admin.organizations.organization.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.organizations.organization.delete', id))
  }
};


watch(
  () => form.organization_region_id,
  () => {
    if (form.organization_region_id) {
      axios
        .post(route('admin.organizations.districts.getlist', { id: form.organization_region_id.id }))
        .then((response) => {
          optionsDistrict = response.data;
          form.organization_district_id = [];
        })
    } else {
      optionsDistrict = [];
      form.organization_district_id = [];
    }
  } //if you need to run callback as soon as prop changes
)

</script>