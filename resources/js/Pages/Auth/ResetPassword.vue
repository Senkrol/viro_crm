<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

import { Head, useForm } from '@inertiajs/vue3';

import FormTextInput from '@/Components/Form/TextInput.vue';

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('password.store'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <GuestLayout>

    <Head title="Reset Password" />

    <form @submit.prevent="submit">


      <FormTextInput :title="'Email'" id="email" v-model="form.email" :message="form.errors.email" required autocomplete="email">
      </FormTextInput>

      <FormTextInput :title="'Пароль'" type="password" id="password" v-model="form.password" required :message="form.errors.password"
        autocomplete="new-password">
      </FormTextInput>


      <FormTextInput :title="'Подтвердите пароль'" type="password" id="password_confirmation" v-model="form.password_confirmation" required :message="form.errors.password_confirmation"
        autocomplete="new-password">
      </FormTextInput>



      <div class="flex items-center justify-end mt-4">
        <button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Сбросить пароль
        </button>
      </div>
    </form>
  </GuestLayout>
</template>
