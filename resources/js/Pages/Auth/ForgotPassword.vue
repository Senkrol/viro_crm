<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

import { Head, useForm } from '@inertiajs/vue3';

import FormTextInput from '@/Components/Form/TextInput.vue';
import SubmitButton from '@/Components/Form/SubmitButton.vue';

defineProps({
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
});

const submit = () => {
  form.post(route('password.email'));
};
</script>

<template>
  <GuestLayout>

    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600">
      Если Вам необходимо изменить или восстановить пароль, укажите адрес электронной почты. На эту почту будет отправлено письмо с сылкой для восстановления пароля.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">

      <FormTextInput :title="'Email'" id="email" v-model="form.email" required :message="form.errors.email"
        autocomplete="username">
      </FormTextInput>

      <SubmitButton :disabled="form.processing">
        Восстановить пароль
      </SubmitButton>
    </form>
  </GuestLayout>
</template>
