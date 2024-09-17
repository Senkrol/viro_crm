<template>
  <AdminLayout>
    <form @submit.prevent="submit">
      <div class="grid grid-cols-2 gap-8">
        <Section>
          <FormHeader>
            Администратор
          </FormHeader>

          <FormTextInput :title="'Фамилия'" id="surname" v-model="form.surname" :message="form.errors.surname" />

          <FormTextInput :title="'Имя'" id="name" v-model="form.name" :message="form.errors.name" />

          <FormTextInput :title="'Отчество'" id="patronymic" v-model="form.patronymic"
            :message="form.errors.patronymic" />


          <FormSelectInput :title="'Отдел'" :id="'viro_department'" v-model="form.viro_department"
            :message="form.errors.viro_department" :options="props.departments" :trackBy="'id'" :labelBy="'title'">
          </FormSelectInput>

          <FormTextInput :title="'Должность'" id="viro_dolgnost" v-model="form.viro_dolgnost"
            :message="form.errors.viro_dolgnost" />

          <FormTextInput :title="'Телефон'" id="phone" v-model="form.phone" :message="form.errors.phone" />

          <FormSelectInput :title="'Регион'" :id="'organization_region_id'" v-model="form.organization_region_id"
            :message="form.errors.organization_region_id" :options="props.regions" :trackBy="'id'"
            :labelBy="'region_title'">
          </FormSelectInput>


          <FormSelectInput :title="'Округ/Район'" :id="'organization_district_id'"
            v-model="form.organization_district_id" :message="form.errors.organization_district_id"
            :options="optionsDistrict" :trackBy="'id'" :labelBy="'district_title'">
          </FormSelectInput>


          <FormSelectInput :title="'Тип'" :id="'organization_type_id'" v-model="form.organization_type_id"
            :message="form.errors.organization_type_id" :options="props.types" :trackBy="'id'" :labelBy="'type_title'">
          </FormSelectInput>

          <FormSelectInput :title="'Учреждение'" :id="'organization_id'" v-model="form.organization_id"
            :message="form.errors.organization_id" :options="optionsOrganizations" :trackBy="'id'"
            :labelBy="'short_name'">
          </FormSelectInput>

          <FormTextInput :title="'Email'" id="email" v-model="form.email" :message="form.errors.email" />

          <FormTextInput :title="'Пароль'" id="password" v-model="form.password" :message="form.errors.password" />

          <div class="grid grid-cols-2 gap-2">
            <DeleteButton @click.prevent="deleteEvent(admin.id)" :disabled="!props.admin">
              Удалить
            </DeleteButton>
            <SubmitButton :disabled="form.processing">
              Сохранить
            </SubmitButton>
          </div>

        </Section>
        <Section>
          <FormHeader>
            Доступы
          </FormHeader>
          <CheckboxGroup name="Administration" v-model:value="selectedPossibilitys"
            :options="possibilitysAdministration" :groupTitle="'Администрирование'" />

          <CheckboxGroup name="Administration" v-model:value="selectedPossibilitys"
            :options="possibilitysDigitalSignatures" :groupTitle="'Цифровые подписи'" />

          <CheckboxGroup name="Administration" v-model:value="selectedPossibilitys" :options="possibilitysOrganizations"
            :groupTitle="'Организации'" />

          <CheckboxGroup name="Administration" v-model:value="selectedPossibilitys" :options="possibilitysStatistics"
            :groupTitle="'Статистика'" />



        </Section>
      </div>
    </form>
  </AdminLayout>
</template>


<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Section from '@/Components/Page/Section.vue';

import FormHeader from '@/Components/Form/Header.vue';
import FormTextInput from '@/Components/Form/TextInput.vue';

import FormSelectInput from '@/Components/Form/SelectInput.vue';
import Checkbox from '@/Components/Checkbox/Checkbox.vue';

import CheckboxGroup from '@/Components/Checkbox/CheckboxGroup.vue';

import SubmitButton from '@/Components/Form/SubmitButton.vue'
import DeleteButton from '@/Components/Form/DeleteButton.vue'

import { useForm, router } from '@inertiajs/vue3';
import axios from 'axios'
import { watch, ref } from 'vue';


let props = defineProps({
  admin: Object,
  regions: Object,
  districts: Object,
  types: Object,
  organizations: Object,
  departments: Object
});


let optionsDistrict = props.districts;
let optionsOrganizations = props.organizations;
// administration_show

let possibilitysAdministration = [
  { name: 'Полный доступ', id: 'administration_full_access' },
];

let possibilitysDigitalSignatures = [
  { name: 'Полный доступ', id: 'digital_signatures_full_access' },
];

let possibilitysOrganizations = [
  { name: 'Полный доступ', id: 'organizations_full_access' },
];


let possibilitysStatistics = [
  { name: 'Доступ к разделу', id: 'statistics_show' },
  { name: 'Муниципальные координаторы', id: 'statistics_mubicipal_admins' },
  { name: 'Руководители организаций', id: 'statistics_organizations_admins' },
];


// определяем общий список для чекбоксов
let listOfSome = ref([]);
//загоняем данные из базы
props.regions.forEach((element) => {
  listOfSome.value.push({ name: element.region_title, id: element.region_number });
});
//то что выбрано в актуале, ну или то что пришло из базы

const form = useForm({

  id: props.admin ? props.admin.id : null,
  name: props.admin ? props.admin.name : "",
  surname: props.admin ? props.admin.surname : "",
  patronymic: props.admin ? props.admin.patronymic : "",

  possibilitys: props.admin ? props.admin.possibilitys.split(',') : "",

  organization_region_id: props.admin ? props.regions.find(option => option.id === props.admin.organization_region_id) : [],
  organization_district_id: props.admin ? props.districts.find(option => option.id === props.admin.organization_district_id) : [],
  organization_type_id: props.admin ? props.types.find(option => option.id === props.admin.organization_type_id) : [],
  organization_id: props.admin ? props.organizations.find(option => option.id === props.admin.organization_id) : [],

  viro_department: props.admin ? props.departments.find(option => option.id === props.admin.viro_department) : [],

  viro_dolgnost: props.admin ? props.admin.viro_dolgnost : "",
  phone: props.admin ? props.admin.phone : "",

  email: props.admin ? props.admin.email : "",
  password: props.admin ? props.admin.password : "",


})


const selectedPossibilitys = ref(props.admin ? form.possibilitys : []);

const submit = () => {
  form.possibilitys = selectedPossibilitys;
  form.post(route(form.id ? 'admin.administration.admin.update' : 'admin.administration.admin.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.administration.admin.delete', id))
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
      optionsOrganizations = [];

      form.organization_district_id = [];
      form.organization_type_id = [];
      form.organization_id = [];
    }
  } //if you need to run callback as soon as prop changes
)


watch(
  () => form.organization_district_id,
  () => {
    optionsOrganizations = [];
    form.organization_type_id = [];
    form.organization_id = [];
  }
)



watch(
  () => form.organization_type_id,
  () => {
    if (form.organization_type_id && form.organization_type_id.id) {

      axios
        .post(route('admin.organizations.getlist', {
          region: form.organization_region_id.id,
          district: form.organization_district_id.id,
          type: form.organization_type_id.id,
        }))
        .then((response) => {
          optionsOrganizations = response.data;
          form.organization_id = [];
        })
    } else {
      optionsOrganizations = [];
      form.organization_id = [];
    }
  }
)
</script>