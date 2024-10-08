<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Муниципальный координатор
        </FormHeader>

        <div v-if="!props.municipalAdmin"> 
          <FormSelectInput :title="'Округ/Район'" :id="'organization_district_id'" v-model="form.organization_district_id"
          :message="form.errors.organization_district_id" :options="props.districts" :trackBy="'id'"
          :labelBy="'district_title'">
        </FormSelectInput>


        <FormSelectInput :title="'Учреждение'" :id="'organization_id'" v-model="form.organization_id"
          :message="form.errors.organization_id" :options="optionsOrganizations" :trackBy="'id'"
          :labelBy="'short_name'">
        </FormSelectInput>
        </div>
     


        <div v-if="organizationInfo" class="mb-4">
          <FormHeader v-if="!props.municipalAdmin">
            Сведения о выбранной организации
          </FormHeader>
          <p>Краткое наименование: {{ organizationInfo.short_name }}</p>
          <p>Руководитель: {{ organizationInfo.director_surname }} {{ organizationInfo.director_name }} {{ organizationInfo.director_patronymic }}</p>
          <p>Адрес: {{ organizationInfo.postal_address }}</p>
          <p>Телефон: {{ organizationInfo.org_phone }}</p>
          <p>Электронная почта: {{ organizationInfo.org_email }}</p>
        </div>

        <div v-if="props.municipalAdmin" class="mb-4 mt-4">

          <Checkbox name="passwordUpdate" v-model:checked="form.passwordUpdate" id="remember"
            :label="'Сгенерировать новый пароль и отправить уведомление'" />
        </div>


        <div class="grid grid-cols-2 gap-2">
          <DeleteButton @click.prevent="deleteEvent(municipalAdmin.id)" :disabled="!props.municipalAdmin">
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
import Checkbox from '@/Components/Checkbox/Checkbox.vue';

import { useForm, router } from '@inertiajs/vue3';

import axios from 'axios'
import { watch, ref } from 'vue';


const props = defineProps({
  municipalAdmin: Object,
  districts: Object,
  organizations: Object,
  organization: Object,
});

const form = useForm({
  id: props.municipalAdmin ? props.municipalAdmin.id : null,
  
  organization_district_id: props.municipalAdmin ? props.districts.find(option => option.id === props.municipalAdmin.organization_district_id) : [],
  organization_id: props.municipalAdmin ? props.organizations.find(option => option.id === props.municipalAdmin.organization_id) : [],

  passwordUpdate: false
})

let optionsOrganizations = props.organizations;

watch(
  () => form.organization_district_id,
  () => {
    if (form.organization_district_id && form.organization_district_id.id) {

      axios
        .post(route('admin.statistics.municipal.admin.getorganizationlist', {
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

let organizationInfo = props.organization ? ref(props.organization) : ref(false);

watch(
  () => form.organization_id,
  () => {
    if (form.organization_id && form.organization_id.id) {
      axios
        .post(route('admin.statistics.municipal.admin.getorganizationinfo', {
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
  form.post(route(form.id ? 'admin.statistics.municipal.admin.update' : 'admin.statistics.municipal.admin.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.statistics.municipal.admin.delete', id))
  }
};

</script>