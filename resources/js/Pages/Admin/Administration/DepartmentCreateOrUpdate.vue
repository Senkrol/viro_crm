<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Отдел
        </FormHeader>


        <FormTextInput :title="'Наименование'" id="title" v-model="form.title"
          :message="form.errors.title">
        </FormTextInput>


        <div class="grid grid-cols-2 gap-2">
          <DeleteButton @click.prevent="deleteEvent(department.id)" :disabled="!props.department">
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
  department: Object
});

const form = useForm({
  id: props.department ? props.department.id : null,
  title: props.department ? props.department.title : "",
})


const submit = () => {
  form.post(route(form.id ? 'admin.administration.department.update' : 'admin.administration.department.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.administration.department.delete', id))
  }
};

</script>