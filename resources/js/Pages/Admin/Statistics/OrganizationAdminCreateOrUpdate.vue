<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Руководитель организации
        </FormHeader>

        <div v-if="!props.organizationAdmin">
          <div v-if="current_admin.admin_type === 1">
            <FormSelectInput :title="'Округ/Район'" :id="'organization_district_id'"
              v-model="form.organization_district_id" :options="props.districts" :trackBy="'id'"
              :labelBy="'district_title'">
            </FormSelectInput>
          </div>




          <FormSelectInput :title="'Тип'" :id="'organization_type_id'" v-model="form.organization_type_id"
            :options="props.types" :trackBy="'id'" :labelBy="'type_title'">
          </FormSelectInput>

          <FormSelectInput :title="'Учреждение'" :id="'organization_id'" v-model="form.organization_id"
            :options="optionsOrganizations" :trackBy="'id'" :labelBy="'short_name'">
          </FormSelectInput>
        </div>

        <div v-if="organizationInfo" class="mb-4">
          <FormHeader v-if="!props.organizationAdmin">
            Сведения о выбранной организации
          </FormHeader>
          
          <p>Краткое наименование: {{ organizationInfo.short_name }}</p>
          <p>Руководитель2: {{ organizationInfo.director_surname }} {{ organizationInfo.director_name }} {{
            organizationInfo.director_patronymic }}</p>
          <p>Адрес: {{ organizationInfo.postal_address }}</p>
          <p>Телефон: {{ organizationInfo.org_phone }}</p>
          <p>Электронная почта: {{ organizationInfo.org_email }}</p>
        </div>

        <div v-if="props.organizationAdmin" class="mb-4 mt-4">
          <Checkbox name="passwordUpdate" v-model:checked="form.passwordUpdate" id="remember"
            :label="'Сгенерировать новый пароль и отправить уведомление'" />
        </div>

        <CheckboxGroup name="Administration" v-model:value="selectedPossibilitys" :options="possibilitysStatistics"
          :groupTitle="'Доступ к разделам и отчетам'" />


        <div class="grid grid-cols-2 gap-2 mt-4">
          <DeleteButton @click.prevent="deleteEvent(organizationAdmin.id)" :disabled="!props.organizationAdmin">
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

import FormSelectInput from '@/Components/Form/SelectInput.vue';

import SubmitButton from '@/Components/Form/SubmitButton.vue'
import DeleteButton from '@/Components/Form/DeleteButton.vue'
import Checkbox from '@/Components/Checkbox/Checkbox.vue';

import CheckboxGroup from '@/Components/Checkbox/CheckboxGroup.vue';

import { useForm, router, usePage } from '@inertiajs/vue3';

import axios from 'axios'
import { watch, ref, onMounted } from 'vue';

const current_admin = usePage().props.auth.user;

const props = defineProps({
  organizationAdmin: Object,
  districts: Object,
  types: Object,
  organizations: Object,
  organization: Object,
});


let optionsOrganizations = props.organizations;

const form = useForm({
  id: props.organizationAdmin ? props.organizationAdmin.id : null,

  organization_district_id: props.organizationAdmin ? props.districts.find(option => option.id === props.organizationAdmin.organization_district_id) : [],
  organization_type_id: props.organizationAdmin ? props.types.find(option => option.id === props.organizationAdmin.organization_type_id) : [],
  organization_id: props.organizationAdmin ? props.organizations.find(option => option.id === props.organizationAdmin.organization_id) : [],

  possibilitys: props.organizationAdmin ? props.organizationAdmin.possibilitys.split(',') : "",

  passwordUpdate: false
})

const selectedPossibilitys = ref(props.organizationAdmin ? form.possibilitys : []);

let possibilitysStatistics = [
  { name: 'Сведения об организации', id: 'statistics_organization_info' },
  { name: 'Отчет ОО-2', id: 'statistics_report_oo2' },
];

let organizationInfo = ref(props.organization ? props.organization : false);


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

    if (form.organization_type_id && form.organization_district_id && form.organization_type_id.id && form.organization_district_id.id) {
      axios
        .post(route('admin.statistics.organizations.admin.getorganizationlist', {
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


watch(
  () => form.organization_id,
  () => {
    if (form.organization_id && form.organization_id.id) {
      axios
        .post(route('admin.statistics.organizations.admin.getorganizationinfo', {
          organization_id: form.organization_id.id
        }))
        .then((response) => {
          organizationInfo.value = response.data;
        })
    } else {
      organizationInfo.value = false;
    }
  }
)


onMounted(() => {
  if (current_admin.admin_type !== 1) {
    form.organization_district_id = props.districts.find(option => option.id === current_admin.organization_district_id);
  }
})


const submit = () => {
  form.possibilitys = selectedPossibilitys;
  form.post(route(form.id ? 'admin.statistics.organizations.admin.update' : 'admin.statistics.organizations.admin.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.statistics.organizations.admin.delete', id))
  }
};

</script>