<script setup>
import GridTableLink from '@/Components/GridTable/GridTableLink.vue';

const props = defineProps({
  values: {
    type: Array,
    required: true,
  },
  routeEdit: {
    type: String
  }
});

let gridCols = 'grid-cols-viro-' + (props.values.length + 1);

</script>

<template>

  <div class="border-b grid " :class="gridCols">
    <div v-for="value in values" class="flex justify-start items-center px-1 py-1">
      <div class="grid grid-table-adaptive-cell w-full">
        <div class="cell-title font-medium">{{ value[0] }}</div>
        <div class="cell-value">{{ value[1] }}</div>
      </div>
    </div>
    <div v-if="props.routeEdit" class="flex justify-center items-center px-1 py-1">
      <GridTableLink :href="routeEdit">
        <font-awesome-icon class="text-viro-second" :icon="['fas', 'pen']" />
        <span class="ml-2">Изменить</span>
      </GridTableLink>
    </div>
  </div>
</template>

<style></style>