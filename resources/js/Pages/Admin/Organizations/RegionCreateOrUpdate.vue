<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Регион
        </FormHeader>

        <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-2">
          <FormTextInput :title="'Номер региона'" id="title" v-model="form.region_number"
            :message="form.errors.region_number">
          </FormTextInput>

          <FormTextInput :title="'Наименование региона'" id="title" v-model="form.region_title"
            :message="form.errors.region_title">
          </FormTextInput>
        </div>

        <div class="grid grid-cols-2 gap-2">
          <DeleteButton @click.prevent="deleteEvent(region.id)" :disabled="!props.region">
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

import SubmitButton from '@/Components/Form/SubmitButton.vue'
import DeleteButton from '@/Components/Form/DeleteButton.vue'

import { useForm, router } from '@inertiajs/vue3';



const props = defineProps({
  region: Object
});

const form = useForm({
  id: props.region ? props.region.id : null,
  region_number: props.region ? props.region.region_number : "",
  region_title: props.region ? props.region.region_title : "",
})


const submit = () => {
  form.post(route(form.id ? 'admin.organizations.region.update' : 'admin.organizations.region.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.organizations.region.delete', id))
  }
};

</script>