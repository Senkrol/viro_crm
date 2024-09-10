<script setup>

import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div class="flex items-center justify-center mb-6">
      <Link :href="route('home')">
        <img class="h-16 w-auto" src="/images/logo.png" alt="">
      </Link>
      
    </div>
    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <slot />
    </div>
  </div>
</template>

<style lang="sass">

body
  background: url('/images/viro_v2.png')
  background-attachment: fixed
  background-position: center


</style>