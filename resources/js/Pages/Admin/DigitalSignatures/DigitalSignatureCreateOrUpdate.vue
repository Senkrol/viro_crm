<template>
  <AdminLayout>

    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Цифровая подпись
        </FormHeader>



        <FormTextInput :title="'Порядковый номер'" id="order_number" v-model="form.order_number"
          :message="form.errors.order_number">
        </FormTextInput>

        <FormSelectInput :title="'Информационная система'" :id="'digital_signatures_isystems_id'" v-model="form.digital_signatures_isystems_id"
          :message="form.errors.order_number" :options="options_isystems" :trackBy="'id'" :labelBy="'title'">
        </FormSelectInput>

        <FormSelectInput :title="'Сотрудник ВИРО'" :id="'user_id'" v-model="form.user_id" :message="form.errors.user_id"
          :options="options_users" :trackBy="'id'" :labelBy="'name'">
        </FormSelectInput>

        <FormTextInput :title="'Серийный ключ'" id="serial_number" v-model="form.serial_number"
          :message="form.errors.serial_number">
        </FormTextInput>

        <FormDatePicker :title="'Дата выдачи'" id="date_start" v-model="form.date_start"
          :message="form.errors.date_start">
        </FormDatePicker>

        <FormDatePicker :title="'Дата окончания'" id="date_end" v-model="form.date_end" :message="form.errors.date_end">
        </FormDatePicker>

        <div class="grid grid-cols-2 gap-2">

          <DeleteButton @click.prevent="deleteEvent(digitalSignature.id)" :disabled="!props.digitalSignature">
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
import FormDatePicker from '@/Components/Form/DatePicker.vue';

import SubmitButton from '@/Components/Form/SubmitButton.vue'
import DeleteButton from '@/Components/Form/DeleteButton.vue'

import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  digitalSignature: Object,
  users: Object,
  isystems: Object,
});

const options_users = props.users;
const options_isystems = props.isystems;

const form = useForm({
  id: props.digitalSignature ? props.digitalSignature.id : null,
  order_number: props.digitalSignature ? props.digitalSignature.order_number : "",
  digital_signatures_isystems_id: props.digitalSignature ? options_isystems.find(option => option.id === props.digitalSignature.digital_signatures_isystems_id) : [],
  user_id: props.digitalSignature ? options_users.find(option => option.id === props.digitalSignature.user_id) : [],
  serial_number: props.digitalSignature ? props.digitalSignature.serial_number : "",
  date_start: props.digitalSignature ? props.digitalSignature.date_start : "",
  date_end: props.digitalSignature ? props.digitalSignature.date_end : "",
})

const submit = () => {

  form.post(route(form.id ? 'admin.digital-signatures.update' : 'admin.digital-signatures.store'), {
    // onError: () => form.reset("title"),
  });
}

const deleteEvent = (id) => {
  if (confirm("Вы уверены, что хотите отправить это в корзину?")) {
    router.delete(route('admin.digital-signatures.delete', id))
  }
};

</script>
