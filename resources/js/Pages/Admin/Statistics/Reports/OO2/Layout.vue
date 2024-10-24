<template>
  <div class="flex flex-col rounded-sm border bg-white shadow-default">
    <div class="flex justify-between p-4 border-b">
      <div class="flex items-center gap-2">
        <font-awesome-icon @click="reportNavigationShow = !reportNavigationShow"
          class="relative flex items-center rounded-sm px-4 py-2 duration-300 ease-in-out border hover:border-viro-main"
          :icon="['fas', 'bars']" />
        <p>Разделы</p>
      </div>
      <div class="flex items-center">
        <p class="text-2xl">{{ props.title }}</p>
      </div>
    </div>
    <div class="flex ">
      <div :class="reportNavigationShow ? 'w-40' : 'w-0'" class="ease-linear duration-200 overflow-hidden">
        <div class="flex flex-col p-4 border-r w-40 gap-1">
          
          <Link v-for="link in props.links" :key="link.part"
            :href="route('admin.statistics.report.oo2.edit', { step: link.part })"
            class="hover:bg-viro-second hover:text-white hover:border-viro-second p-2 rounded-r-sm border-l-4"
            :class="(activeStep == link.part) ? '!border-viro-second' : ''">
          {{ link.title }}
          </Link>

        </div>
      </div>

      <div class="p-4 h-fit flex flex-1 flex-col overflow-hidden">
        <slot />
      </div>
    </div>
  </div>

</template>

<script setup>

import { Link } from '@inertiajs/vue3';
const reportNavigationShow = ref(true);
import { ref } from 'vue';
const props = defineProps({
  title: {
    type: String,
    default: ''
  },
  links: {
    type: Object
  },
  activeStep: {
    type: String,
  }
});


</script>