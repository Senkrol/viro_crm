<script setup>

import { Link, router } from '@inertiajs/vue3';

defineProps({
  paginator: {
    type: Object,
    required: true,
  },
});



/**
 * 
 * 
 *        <component :is="link.url ? 'Link' : 'span'" :href="link.url" 
          class="" 
          :class="{' hover:bg-slate-300': link.url,'text-zinc-400': !link.url, 'font-bold text-blue-500': link.active }">
          
        </component>

 */
</script>

<template>
  <div class="flex justify-between items-start mt-4">
    <div class="flex items-center rounded-md overflow-hidden border">
      <div v-for="link in paginator.links" :key="link.url">

        <Link v-if="link.url" :href="link.url"
          class="border-x border-slate-50 w-12 h-12 grid font-medium place-items-center bg-white hover:bg-slate-300"
          :class="{ 'font-bold text-viro-red': link.active }">

          <font-awesome-icon v-if="link.label.includes('Следующий')" :icon="['fas', 'angles-right']" />
          <font-awesome-icon v-else-if="link.label.includes('Предыдущий')" :icon="['fas', 'angles-left']" />
          <p v-else>{{ link.label }}</p>
        </Link>
        <span v-else class="border-x border-slate-50 w-12 h-12 grid  font-medium place-items-center bg-white text-zinc-400">
          <font-awesome-icon v-if="link.label.includes('Следующий')" :icon="['fas', 'angles-right']" />
          <font-awesome-icon v-else-if="link.label.includes('Предыдущий')" :icon="['fas', 'angles-left']" />
          <p v-else>{{ link.label }}</p>
        </span>
        
      </div>
    </div>
    <p class="text-slate-600 text-sm">Записи с {{ paginator.from }} по {{ paginator.to }} из {{ paginator.total }}</p>
  </div>
</template>