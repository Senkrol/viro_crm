<script setup>

const props = defineProps({
  title: {
    type: String,
  }
});

</script>

<template>

  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-3xl font-bold  dark:text-white">
      {{ title }}
    </h2>
    
    <div class="flex gap-3">
      <slot />
    </div>
    
  </div>
</template>