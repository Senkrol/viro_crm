<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
});

</script>

<template>
  <Link
    class="grid-table-link relative flex w-full justify-center items-center rounded-sm px-4 py-2 duration-300 ease-in-out border hover:border-viro-main"
    :href="href">
  <slot />
  </Link>
</template>
