<template>
  <AdminLayout>
    <Section>
      пусть тут будет отчет
    </Section>
  </AdminLayout>
</template>


<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Section from '@/Components/Page/Section.vue';

import FormHeader from '@/Components/Form/Header.vue';
import FormTextInput from '@/Components/Form/TextInput.vue';

import SubmitButton from '@/Components/Form/SubmitButton.vue'

import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
 
});




</script>