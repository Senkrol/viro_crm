<script setup>

import { computed } from 'vue';

const props = defineProps({
  active: {
    type: Boolean,
  },
  title: {
    type: String,
  },
  icon: {
    type: Object
  }
});

const classes = computed(() =>
  props.active
    ? 'bg-viro-second'
    : ''
);

</script>

<template>

  <div class="relative flex flex-col items-left">
    <div :class="classes"
      class="relative flex items-center justify-between gap-2 px-2 py-2 text-white font-medium cursor-pointer rounded-sm duration-300 ease-in-out hover:bg-viro-second">
      <div class="flex items-center gap-2">
        <font-awesome-icon :icon="icon" class="w-6" />
        <p>{{ title }}</p>
      </div>
      <font-awesome-icon :icon="['fas', 'angle-down']" :class="active ? 'rotate-180' : ''" />
    </div>

    <div :class="active ? '' : 'hidden'">
      <slot />
    </div>

  </div>


</template>