<template>
  <AdminLayout>
    <Section>
      <form @submit.prevent="submit">

        <FormHeader>
          Область
        </FormHeader>

          <FormTextInput :title="'Номер области'" id="title" v-model="form.district_number"
            :message="form.errors.district_number">
          </FormTextInput>

          <FormTextInput :title="'Наименование области'" id="title" v-model="form.district_title"
            :message="form.errors.district_title">
          </FormTextInput>
      
          <FormSelectInput :title="'Регион'" :id="'organization_region_id'" v-model="form.organization_region_id" :message="form.errors.organization_region_id"
          :options="regions" :trackBy="'id'" :labelBy="'region_title'">
        </FormSelectInput>

        
        <div class="grid grid-cols-2 gap-2">
          <DeleteButton @click.prevent="deleteEvent(district.id)" :disabled="!props.district">
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

import { useForm , router} from '@inertiajs/vue3';




const props = defineProps({
  district: Object,
  regions: Object,
});

const form = useForm({
  id: props.district ? props.district.id : null,
  district_number: props.district ? props.district.district_number : "",
  district_title: props.district ? props.district.district_title : "",
  organization_region_id: props.district ? props.regions.find(option => option.id === props.district.organization_region_id) : [],
})


const submit = () => {
  form.post(route(form.id ? 'admin.organizations.district.update' : 'admin.organizations.district.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.organizations.district.delete', id))
  }
};
</script>