<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

import FormTextInput from '@/Components/Form/TextInput.vue';

import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
  password: '',
});

const submit = () => {
  form.post(route('password.confirm'), {
    onFinish: () => form.reset(),
  });
};
</script>

<template>
  <GuestLayout>

    <Head title="Confirm Password" />

    <div class="mb-4 text-sm text-gray-600">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form @submit.prevent="submit">


      <FormTextInput :title="'Пароль'" id="password" v-model="form.password" :message="form.errors.password"
        autocomplete="current-password" type="password" required>
      </FormTextInput>


      <div class="flex justify-end mt-4">

        <button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Confirm
        </button>

      </div>
    </form>
  </GuestLayout>
</template>
