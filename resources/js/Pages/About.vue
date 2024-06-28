<script setup>

import Main from '../Layouts/Main.vue';
defineOptions({ layout: Main });

defineProps({
  user: String
})
</script>
<template>

  <Head>
    <title>| О чем то</title>
  </Head>

  <div>
    <h1>Hi mr. {{ user }}</h1>
  </div>
</template>
