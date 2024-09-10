<script setup>

const props = defineProps({
  disabled: {
    type: Boolean,
  },
});

</script>

<template>
  <div>
    <button type="submit" :disabled="disabled"
      class="disabled:cursor-wait disabled:opacity-75 flex justify-center w-full text-nowrap border-y border-x border-viro-main rounded bg-viro-main text-white px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      <slot />
    </button>
  </div>

</template>
