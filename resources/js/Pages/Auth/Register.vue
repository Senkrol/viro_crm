<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';

import FormHeader from '@/Components/Form/Header.vue';
import FormTextInput from '@/Components/Form/TextInput.vue';

import SubmitButton from '@/Components/Form/SubmitButton.vue';
import LinkOrdinary from '@/Components/Form/LinkOrdinary.vue';

const form = useForm({
  surname: '',
  name: '',
  patronymic: '',
  snils: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <GuestLayout>

    <Head title="Register" />

    <form @submit.prevent="submit">

      <FormHeader>
        Регистрация
      </FormHeader>

      <FormTextInput :title="'Фамилия'" id="surname" v-model="form.surname" required :message="form.errors.surname" />

      <FormTextInput :title="'Имя'" id="name" v-model="form.name" required :message="form.errors.name" />

      <FormTextInput :title="'Отчество'" id="patronymic" v-model="form.patronymic" required
        :message="form.errors.patronymic" />

      <FormTextInput :title="'СНИЛС'" id="snils" v-model="form.snils" required :message="form.errors.snils" />

      <FormTextInput :title="'email'" id="email" v-model="form.email" required :message="form.errors.email" />

      <FormTextInput :title="'Пароль'" id="password" type="password" v-model="form.password" required
        :message="form.errors.password" />

      <FormTextInput :title="'Подтвердите пароль'" id="password_confirmation" type="password"
        v-model="form.password_confirmation" required :message="form.errors.password_confirmation" />

      <div class="grid grid-cols-2 py-2 items-end">

        <LinkOrdinary :href="route('login')" :align="'text-left'">Уже зарегистрированы?</LinkOrdinary>

        <SubmitButton :disabled="form.processing">
          Регистрация
        </SubmitButton>

      </div>
    </form>
  </GuestLayout>
</template>
