<template>

  <div :class="gridColumnsStyle">
    <slot />
  </div>

</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  cols: {
    type: Number,
    required: true,
  },
});

const gridColumnsStyle = computed(() => {
  if (props.cols === 2) {
    return 'grid grid-cols-2 gap-2 my-2';
  } else if (props.cols === 3) {
    return 'grid grid-cols-3 gap-2 my-2';
  } else if (props.cols === 4) {
    return 'grid grid-cols-4 gap-2 my-2';
  } else if (props.cols === 5) {
    return 'grid grid-cols-5 gap-2 my-2';
  } else {
    return 'grid grid-cols-1 my-2';
  }
});

</script>