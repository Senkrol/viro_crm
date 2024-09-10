<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
  disabled: {
    type: Boolean,
  },
  href: {
    type: String
  },
  light: {
    type: Boolean,
    default: false,
  }
});

</script>

<template>
  <div>
    <Link :href="href" :disabled="disabled"
      :class="light ? 'bg-white text-viro-main hover:bg-viro-main hover:text-white' : 'bg-viro-main text-white hover:bg-opacity-90'"
      class="disabled:cursor-wait disabled:opacity-75 flex justify-center w-full border-y border-x border-viro-main rounded px-6 py-2 font-medium">
    <slot />
    </Link>
  </div>

</template>
