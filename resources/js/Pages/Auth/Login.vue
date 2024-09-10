<script setup>


import Checkbox from '@/Components/Checkbox/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import SubmitButton from '@/Components/Form/SubmitButton.vue';
import LinkOrdinary from '@/Components/Form/LinkOrdinary.vue';
//import PrimaryButton from '@/Components/PrimaryButton.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';


import FormTextInput from '@/Components/Form/TextInput.vue';


defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>

  <GuestLayout>

    <Head title="Авторизация" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">

      <FormTextInput :title="'Email'" id="email" v-model="form.email" :message="form.errors.email"
        autocomplete="username">
      </FormTextInput>

      <FormTextInput :title="'Пароль'" id="password" v-model="form.password" :message="form.errors.password"
        autocomplete="current-password" type="password">
      </FormTextInput>

      <div class="grid grid-cols-2 py-2">
        <Checkbox name="remember" v-model:checked="form.remember" id="remember" :label="'Запомнить меня'" />

        <LinkOrdinary v-if="canResetPassword" :href="route('password.request')" :align="'text-right'">Забыли пароль?</LinkOrdinary>

      </div>


      <SubmitButton :disabled="form.processing">
        Войти
      </SubmitButton>

    </form>
  </GuestLayout>
</template>
