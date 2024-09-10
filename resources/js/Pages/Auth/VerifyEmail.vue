<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';


import FormHeader from '@/Components/Form/Header.vue';


import SubmitButton from '@/Components/Form/SubmitButton.vue';
import LinkOrdinary from '@/Components/Form/LinkOrdinary.vue';


const props = defineProps({
  status: {
    type: String,
  },
});

const form = useForm({});

const submit = () => {
  form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
  <GuestLayout>

    <Head title="Email Verification" />

    <FormHeader>Завершение регистрации</FormHeader>
    <div class="mb-4 mt-2 text-sm text-gray-600 text-justify">
      <p>Спасибо, что зарегистрировались!</p>
      <p>Прежде чем приступить к работе, подтвердите адрес электронной почты, перейдя по ссылке,
        которую система только что отправила.</p>
      <p>Если Вы не получили это письмо в течении 5 минут, то нажмите на кнопку "Отправить повторно".</p>

    </div>

    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
      На адрес электронной почты, который вы указали при регистрации, была отправлена новая ссылка для подтверждения.
    </div>

    <form @submit.prevent="submit">


      <div class="grid grid-cols-2 py-2 items-end">

        <LinkOrdinary :href="route('logout')" :align="'text-left'">Выйти</LinkOrdinary>

        <SubmitButton :disabled="form.processing">
          Отправить повторно
        </SubmitButton>

      </div>
    </form>
  </GuestLayout>
</template>
