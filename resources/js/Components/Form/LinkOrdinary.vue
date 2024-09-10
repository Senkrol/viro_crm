<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
  href: {
    type: String
  },
  align:{
    type: String,
    default: 'text-left'
  }
});

</script>

<template>
  <div :class="align">
    <Link :href="href"
      class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">
    <slot />
    </Link>
  </div>

</template>
