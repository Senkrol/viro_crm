<template>
  <AdminLayout>
    <Section>

      <form @submit.prevent="submit">

        <FormHeader>
          Ваш муниципальный координатор
        </FormHeader>

        <p>Муниципальный координатор</p>

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
        <FormTextInput :title="'Наименование - краткое'" id="short_name" v-model="form.short_name"
          :message="form.errors.short_name">
        </FormTextInput>

        <FormTextInput :title="'Наименование - полное'" id="full_name" v-model="form.full_name"
          :message="form.errors.full_name">
        </FormTextInput>

        <FormTextInput :title="'ИНН'" id="inn" v-model="form.inn" :message="form.errors.inn">
        </FormTextInput>

        <FormTextInput :title="'Код ОУ'" id="code_OU" v-model="form.code_OU" :message="form.errors.code_OU">
        </FormTextInput>

        <FormTextInput :title="'Почтовый адрес'" id="postal_address" v-model="form.postal_address"
          :message="form.errors.postal_address">
        </FormTextInput>

        <FormTextInput :title="'Фамилия руководителя'" id="director_surname" v-model="form.director_surname"
          :message="form.errors.director_surname">
        </FormTextInput>

        <FormTextInput :title="'Имя руководителя'" id="director_name" v-model="form.director_name"
          :message="form.errors.director_name">
        </FormTextInput>

        <FormTextInput :title="'Отчество руководителя'" id="director_patronymic" v-model="form.director_patronymic"
          :message="form.errors.director_patronymic">
        </FormTextInput>

        <FormTextInput :title="'Телефон'" id="org_phone" v-model="form.org_phone" :message="form.errors.org_phone">
        </FormTextInput>

        <FormTextInput :title="'Электронная почта (является логином для входа)'" id="org_email" v-model="form.org_email"
          :message="form.errors.org_email">
        </FormTextInput>


        <div class="grid grid-cols-1 gap-2 mt-4">
          <SubmitButton :disabled="form.processing">
            Обновить
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

import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  organization: Object,
});



let optionsVillageCity = [{ 'id': 1, 'title': 'Город' }, { 'id': 2, 'title': 'Село' }];


const form = useForm({

  id: props.organization ? props.organization.id : null,

  code_OU: props.organization ? props.organization.code_OU : "",
  full_name: props.organization ? props.organization.full_name : "",
  short_name: props.organization ? props.organization.short_name : "",

  postal_address: props.organization ? props.organization.postal_address : "",

  director_surname: props.organization ? props.organization.director_surname : "",
  director_name: props.organization ? props.organization.director_name : "",
  director_patronymic: props.organization ? props.organization.director_patronymic : "",

  inn: props.organization ? props.organization.inn : "",
  org_phone: props.organization ? props.organization.org_phone : "",
  org_email: props.organization ? props.organization.org_email : "",

})


const submit = () => {
  form.post(route('admin.organizations.organization.update'), {
    // onError: () => form.reset("title"),
  });
}



</script>