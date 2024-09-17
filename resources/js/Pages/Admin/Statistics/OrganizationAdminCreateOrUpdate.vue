<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Руководитель организации
        </FormHeader>

        <FormSelectInput v-if="!props.organizationAdmin" :title="'Учреждение'" :id="'organization_id'" v-model="form.organization_id"
          :message="form.errors.organization_id" :options="props.organizations" :trackBy="'id'" :labelBy="'short_name'">
        </FormSelectInput>

        <div v-if="organizationInfo" class="mb-4">
          <FormHeader>
            Сведения о выбранной организации
          </FormHeader>
          <p>Краткое наименование: {{ organizationInfo.short_name }}</p>
          <p>Руководитель: {{ organizationInfo.director_surname }} {{ organizationInfo.director_name }} {{
            organizationInfo.director_patronymic }}</p>
          <p>Адрес: {{ organizationInfo.postal_address }}</p>
          <p>Телефон: {{ organizationInfo.org_phone }}</p>
          <p>Электронная почта: {{ organizationInfo.org_email }}</p>
        </div>

        <div v-if="props.organizationAdmin" class="mb-4 mt-4">

          <Checkbox name="passwordUpdate" v-model:checked="form.passwordUpdate" id="remember"
            :label="'Сгенерировать новый пароль и отправить уведомление'" />
        </div>


        <div class="grid grid-cols-2 gap-2">
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
import FormTextInput from '@/Components/Form/TextInput.vue';
import FormSelectInput from '@/Components/Form/SelectInput.vue';

import SubmitButton from '@/Components/Form/SubmitButton.vue'
import DeleteButton from '@/Components/Form/DeleteButton.vue'
import Checkbox from '@/Components/Checkbox/Checkbox.vue';

import { useForm, router } from '@inertiajs/vue3';

import axios from 'axios'
import { watch, ref } from 'vue';


const props = defineProps({
  organizationAdmin: Object,
  organizations: Object,
  organization: Object,
});

const form = useForm({
  id: props.organizationAdmin ? props.organizationAdmin.id : null,

  organization_id: props.organizationAdmin ? props.organizations.find(option => option.id === props.organizationAdmin.organization_id) : [],

  passwordUpdate: false
})



let organizationInfo = ref(props.organization ? props.organization : false);

watch(
  () => form.organization_id,
  () => {
    if (form.organization_id && form.organization_id.id) {
      axios
        .post(route('admin.statistics.organization.admin.getorganizationinfo', {
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


const submit = () => {
  form.post(route(form.id ? 'admin.statistics.organization.admin.update' : 'admin.statistics.organization.admin.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.statistics.organization.admin.delete', id))
  }
};

</script>