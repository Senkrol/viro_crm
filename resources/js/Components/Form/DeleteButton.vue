<script setup>
const props = defineProps({
  disabled: {
    type: Boolean,
  },
});
</script>

<template>
  <div>
    <button :disabled="disabled"
      class="disabled:cursor-not-allowed disabled:grayscale flex justify-center w-full cursor-pointer rounded bg-white border-y border-x border-viro-red text-viro-red px-6 py-2 font-medium text-gray hover:bg-opacity-90">
      <slot />
    </button>
  </div>
</template>
