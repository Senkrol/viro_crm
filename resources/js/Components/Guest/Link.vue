<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
  disabled: {
    type: Boolean,
  },
  href: {
    type: String
  },
  icon: {
    type: Object,
    required: true,
  }
});

</script>

<template>
  <Link :href="href"
    class="text-white hover:bg-[#ffffff33] flex justify-start items-center border-2 rounded-lg px-4 py-4 pointer w-full font-medium text-xl">
  <font-awesome-icon :icon="icon" class="w-6 mr-2 text-red" />
  <slot />
  </Link>
</template>
