<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
  },
  icon: {
    type: Object,
    required: true,
  }
});

const classes = computed(() =>
  props.active
    ? 'text-viro-red'
    : 'text-white'
);
</script>

<template>
  <Link
    class="relative flex items-center gap-2 rounded-sm px-2 py-2 font-medium  duration-300 ease-in-out hover:bg-viro-second dark:hover:bg-meta-4"
    :href="href" :class="classes">
    <font-awesome-icon :icon="icon" class="w-6" />
  <slot />
  </Link>
</template>
