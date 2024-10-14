<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Ваш муниципальный координатор
        </FormHeader>
        <p>ФИО: {{ props.municipalAdmin.surname }} {{ props.municipalAdmin.name }} {{ props.municipalAdmin.patronymic }}
        </p>
        <p>Email: {{ props.municipalAdmin.email }}</p>
        <p>Телефон: {{ props.municipalAdmin.phone }}</p>

        <FormHeader>
          Фиксированные данные
        </FormHeader>
        
        <p>Регион: {{ props.organization.region_title }}</p>
        <p>Округ: {{ props.organization.district_title }} </p>
        <p>Учредитель: {{ props.organization.founder_title }}</p>
        <p>Тип учреждения: {{ props.organization.type_title }} </p>
        <p>Тип населенного пункта: {{ props.organization.village_city == 1 ? 'Город' : 'Cело' }}</p>

        <FormHeader>
          Сведения доступные для изменения
        </FormHeader>

        <GridLines>
          <FormTextInput :title="'Наименование - краткое'" id="short_name" v-model="form.short_name"
            :message="form.errors.short_name" />
        </GridLines>

        <GridLines>
          <FormTextInput :title="'Наименование - полное'" id="full_name" v-model="form.full_name"
            :message="form.errors.full_name" />
        </GridLines>

        <GridLines :cols="5">
          <FormTextInput :title="'ОКПО'" id="okpo" v-model="form.okpo" :message="form.errors.okpo" />
          <FormTextInput :title="'ИНН'" id="inn" v-model="form.inn" :message="form.errors.inn" />
          <FormTextInput :title="'КПП'" id="kpp" v-model="form.kpp" :message="form.errors.kpp" />
          <FormTextInput :title="'ОГРН'" id="ogrn" v-model="form.ogrn" :message="form.errors.ogrn" />
          <FormTextInput :title="'Код ОУ'" id="code_OU" v-model="form.code_OU" :message="form.errors.code_OU" />
        </GridLines>

        <GridLines>
          <FormTextInput :title="'Почтовый адрес'" id="postal_address" v-model="form.postal_address"
            :message="form.errors.postal_address" />
        </GridLines>

        <GridLines :cols="3">
          <FormTextInput :title="'Фамилия руководителя'" id="director_surname" v-model="form.director_surname"
            :message="form.errors.director_surname" />

          <FormTextInput :title="'Имя руководителя'" id="director_name" v-model="form.director_name"
            :message="form.errors.director_name" />

          <FormTextInput :title="'Отчество руководителя'" id="director_patronymic" v-model="form.director_patronymic"
            :message="form.errors.director_patronymic" />

        </GridLines>

        <GridLines :cols="2">
          <FormTextInput :title="'Телефон'" id="org_phone" v-model="form.org_phone" :message="form.errors.org_phone" />

          <FormTextInput :title="'Основная почта организации'" id="org_email"
            v-model="form.org_email" :message="form.errors.org_email" />
        </GridLines>

        <GridLines>
          <SubmitButton :disabled="form.processing">
            Обновить
          </SubmitButton>
        </GridLines>
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

import GridLines from '@/Components/Form/GridLines.vue'

import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  organization: Object,
  municipalAdmin: Object,
});


const form = useForm({

  id: props.organization ? props.organization.id : null,

  code_OU: props.organization ? props.organization.code_OU : "",
  full_name: props.organization ? props.organization.full_name : "",
  short_name: props.organization ? props.organization.short_name : "",

  postal_address: props.organization ? props.organization.postal_address : "",

  director_surname: props.organization ? props.organization.director_surname : "",
  director_name: props.organization ? props.organization.director_name : "",
  director_patronymic: props.organization ? props.organization.director_patronymic : "",

  okpo: props.organization ? props.organization.okpo : "",
  inn: props.organization ? props.organization.inn : "",
  kpp: props.organization ? props.organization.kpp : "",
  ogrn: props.organization ? props.organization.ogrn : "",

  org_phone: props.organization ? props.organization.org_phone : "",
  org_email: props.organization ? props.organization.org_email : "",

})


const submit = () => {
  form.post(route('admin.statistics.organizations.organization.update'), {
    // onError: () => form.reset("title"),
  });
}



</script>