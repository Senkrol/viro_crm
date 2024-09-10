<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Региональный координатор
        </FormHeader>


        <FormTextInput :title="'Фамилия'" id="surname" v-model="form.surname" :message="form.errors.surname" />

        <FormTextInput :title="'Имя'" id="name" v-model="form.name" :message="form.errors.name" />

        <FormTextInput :title="'Отчество'" id="patronymic" v-model="form.patronymic"
          :message="form.errors.patronymic" />

        <FormSelectInput :title="'Округ/Район'" :id="'organization_district_id'" v-model="form.organization_district_id"
          :message="form.errors.organization_district_id" :options="props.districts" :trackBy="'id'"
          :labelBy="'district_title'">
        </FormSelectInput>


        <FormSelectInput :title="'Учреждение'" :id="'organization_id'" v-model="form.organization_id"
          :message="form.errors.organization_id" :options="optionsOrganizations" :trackBy="'id'"
          :labelBy="'short_name'">
        </FormSelectInput>


        <div v-if="organizationInfo" class="mb-4">
          <FormHeader>
            Сведения о выбранной организации
          </FormHeader>
          <p>Краткое наименование: {{ organizationInfo.short_name }}</p>
          <p>Руководитель: {{ organizationInfo.director_fio }}</p>
          <p>Адрес: {{ organizationInfo.postal_address }}</p>
          <p>Телефон: {{ organizationInfo.org_phone }}</p>
          <p>Электронная почта: {{ organizationInfo.org_email }}</p>
        </div>

        <div v-if="props.admin">
          Обновить пароль
        </div>


        <div class="grid grid-cols-2 gap-2">
          <DeleteButton @click.prevent="deleteEvent(admin.id)" :disabled="!props.admin">
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

import SubmitButton from '@/Components/Form/SubmitButton.vue'
import DeleteButton from '@/Components/Form/DeleteButton.vue'

import { useForm, router } from '@inertiajs/vue3';

import axios from 'axios'
import { watch, ref } from 'vue';


const props = defineProps({
  districts: Object,
  admin: Object,
  organizations: Object
});

const form = useForm({
  surname: props.type ? props.type.surname : "",
  name: props.type ? props.type.name : "",
  patronymic: props.type ? props.type.patronymic : "",

  organization_district_id: props.admin ? props.districts.find(option => option.id === props.admin.organization_district_id) : [],
  organization_id: props.admin ? props.organizations.find(option => option.id === props.admin.organization_id) : [],
})

let optionsOrganizations = props.organizations;

watch(
  () => form.organization_district_id,
  () => {
    if (form.organization_district_id && form.organization_district_id.id) {

      axios
        .post(route('admin.statistics.regional.admin.getorganizationlist', {
          region: 1,
          district: form.organization_district_id.id,
          type: 7,
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

let organizationInfo = ref(false);

watch(
  () => form.organization_id,
  () => {
    if (form.organization_id && form.organization_id.id) {
      axios
        .post(route('admin.statistics.regional.admin.getorganizationinfo', {
          organization_id: form.organization_id.id
        }))
        .then((response) => {
          console.log(response);
          organizationInfo.value = response.data;
        })
    } else {
      organizationInfo.value = false;
    }
  }
)


const submit = () => {
  form.post(route(form.id ? 'admin.statistics.regional.admin.update' : 'admin.statistics.regional.admin.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.statistics.regional.admin.delete', id))
  }
};

</script>