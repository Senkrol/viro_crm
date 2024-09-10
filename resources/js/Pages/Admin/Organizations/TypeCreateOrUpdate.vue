<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Тип
        </FormHeader>


        <FormTextInput :title="'Наименование'" id="title" v-model="form.type_title"
          :message="form.errors.type_title">
        </FormTextInput>


        <div class="grid grid-cols-2 gap-2">
          <DeleteButton @click.prevent="deleteEvent(type.id)" :disabled="!props.type">
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
  type: Object
});

const form = useForm({
  id: props.type ? props.type.id : null,
  type_title: props.type ? props.type.type_title : "",
})


const submit = () => {
  form.post(route(form.id ? 'admin.organizations.type.update' : 'admin.organizations.type.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.organizations.type.delete', id))
  }
};

</script>