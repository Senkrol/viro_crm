<script setup>
import { ref } from 'vue';

import { usePage } from '@inertiajs/vue3'

import NavLink from '@/Components/LeftSideMenu/NavLink.vue';
import SidebarLink from '@/Components/LeftSideMenu/SidebarLink.vue';
import SidebarGroup from '@/Components/LeftSideMenu/SidebarGroup.vue';
import SidebarGroupLink from '@/Components/LeftSideMenu/SidebarGroupLink.vue';
import LogoBase from '@/Components/LeftSideMenu/LogoBase.vue';

const adminPossibilitys = usePage().props.auth.user.possibilitys.split(',');
// v-if="adminPossibilitys.includes('some')"

const navigationShow = ref(false);
const LinkGroup = ref("");




</script>

<template>

  <div class="antialiased bg-gray-100 dark:bg-gray-900 flex h-screen">


    <aside :class="navigationShow ? 'translate-x-0' : '-translate-x-full'"
      class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-viro-main duration-300 ease-linear lg:static lg:translate-x-0 -translate-x-full">

      <div class="flex flex-row px-4 pt-4 items-center justify-between lg:justify-center lg:flex-col">
        <LogoBase />

        <font-awesome-icon class="text-white lg:hidden" @click="navigationShow = !navigationShow"
          :icon="['fas', 'arrow-left']" />
      </div>

      <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">

        <nav class="px-2 py-4 flex flex-col gap-2">

          <SidebarLink :href="route('user.dashboard')" :active="route().current('admin.dashboard')"
            :icon="['fas', 'house']">
            Главная
          </SidebarLink>

        </nav>
      </div>
    </aside>

    <div class="relative flex flex-1 flex-col  overflow-y-auto overflow-x-hidden">
      <header class="sticky top-0 z-999 flex w-full bg-white drop-shadow dark:bg-boxdark dark:drop-shadow-none">
        <div class="flex flex-grow items-center justify-between py-4 md:px-6 2xl:px-11 lg:justify-end  px-4 ">
          <font-awesome-icon @click="navigationShow = !navigationShow" class="relative flex items-center rounded-sm px-4 py-2 duration-300 ease-in-out border hover:border-viro-main
      lg:hidden" :icon="['fas', 'bars']" />

          <NavLink :href="route('logout')" method="post" as="button">
            Выйти
          </NavLink>
        </div>
      </header>

      <main class="mx-auto w-full flex flex-1 flex-col p-4 text-black md:p-6 2xl:p-10">
        <div v-if="$page.props.flash.success" class="p-4 bg-lime-400 mb-4 rounded-md w-full">
          {{ $page.props.flash.success }}
        </div>

        <slot />

      </main>
    </div>
  </div>
</template>
