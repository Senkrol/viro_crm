<template>
  <AdminLayout>
    <Section>
      <form @submit.prevent="submit">
        <FormHeader>
          Информационная система
        </FormHeader>
        <FormTextInput :title="'Наименование иноформационной системы'" id="title" v-model="form.title"
          :message="form.errors.title">
        </FormTextInput>
        <div class="grid grid-cols-2 gap-2">
          <DeleteButton @click.prevent="deleteEvent(isystem.id)" :disabled="!props.isystem">
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
  isystem: Object
});

const form = useForm({
  id: props.isystem ? props.isystem.id : null,
  title: props.isystem ? props.isystem.title : "",
})


const submit = () => {
  form.post(route(form.id ? 'admin.digital-signatures.isystems.update' : 'admin.digital-signatures.isystems.store'), {
    onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.digital-signatures.isystems.delete', id))
  }
};

</script>