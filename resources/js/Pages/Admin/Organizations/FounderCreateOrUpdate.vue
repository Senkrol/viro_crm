<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Учредитель
        </FormHeader>


        <FormTextInput :title="'Наименование'" id="title" v-model="form.founder_title"
          :message="form.errors.founder_title">
        </FormTextInput>


        <div class="grid grid-cols-2 gap-2">
          <DeleteButton @click.prevent="deleteEvent(founder.id)" :disabled="!props.founder">
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
  founder: Object
});

const form = useForm({
  id: props.founder ? props.founder.id : null,
  founder_title: props.founder ? props.founder.founder_title : "",
})


const submit = () => {
  form.post(route(form.id ? 'admin.organizations.founder.update' : 'admin.organizations.founder.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.organizations.founder.delete', id))
  }
};

</script>