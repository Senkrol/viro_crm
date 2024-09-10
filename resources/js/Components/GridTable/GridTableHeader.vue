<script setup>
import GridTableLink from '@/Components/GridTable/GridTableLink.vue';

const props = defineProps({
  headers: {
    type: Array,
    required: true,
  }
});


let gridCols = 'grid-cols-viro-' + (props.headers.length + 1);

</script>

<template>
  <div class="border-b grid grid-table-header" :class="gridCols">
    <div v-for="header in headers" class="flex justify-start items-center px-1 py-1">
      <p>{{ header }}</p>
    </div>
  </div>
</template>