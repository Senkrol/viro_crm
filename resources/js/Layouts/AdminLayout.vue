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

// группа - электронные цифровые подписи
if (route().current().includes('admin.digital-signatures')) {
  LinkGroup.value = 'Digital-signatures';
}

// группа - организации
if (route().current().includes('admin.organizations')) {
  LinkGroup.value = 'Organizations';
}

// группа - администрирование
if (route().current().includes('admin.administration')) {
  LinkGroup.value = 'Administration';
}

// группа - статистика
if (route().current().includes('admin.statistics')) {
  LinkGroup.value = 'Statistics';
}

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

          <SidebarLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')"
            :icon="['fas', 'house']">
            Главная
          </SidebarLink>

          <div v-if="adminPossibilitys.includes('administration_full_access')">
            <SidebarGroup :title="'Администрирование'"
              @click="LinkGroup = (LinkGroup === 'Administration' ? '' : 'Administration')"
              :active="LinkGroup == 'Administration' ? true : false" :icon="['fas', 'screwdriver-wrench']">
            </SidebarGroup>

            <div v-if="LinkGroup == 'Administration'" @click="LinkGroup = 'Administration'">

              <SidebarGroupLink :href="route('admin.administration.admins.index')"
                :active="route().current().includes('admin.administration.admin')">
                Администраторы
              </SidebarGroupLink>

              <SidebarGroupLink :href="route('admin.administration.departments.index')"
                :active="route().current().includes('admin.administration.department')">
                Отделы
              </SidebarGroupLink>

            </div>
          </div>

          <div v-if="adminPossibilitys.includes('digital_signatures_full_access')">

            <SidebarGroup :title="'Цифровые подписи'"
              @click="LinkGroup = (LinkGroup === 'Digital-signatures' ? '' : 'Digital-signatures')"
              :active="LinkGroup == 'Digital-signatures' ? true : false" :icon="['fas', 'key']">
            </SidebarGroup>

            <div v-if="LinkGroup == 'Digital-signatures'" @click="LinkGroup = 'Digital-signatures'">

              <SidebarGroupLink :href="route('admin.digital-signatures.digital-signatures.index')"
                :active="route().current().includes('admin.digital-signatures.digital-signatures')">
                Учет выданных
              </SidebarGroupLink>

              <SidebarGroupLink :href="route('admin.digital-signatures.isystems.index')"
                :active="route().current().includes('admin.digital-signatures.isystems')">
                Информационные системы
              </SidebarGroupLink>

            </div>
          </div>

          <div v-if="adminPossibilitys.includes('organizations_full_access')">
            <SidebarGroup :title="'Организации'"
              @click="LinkGroup = (LinkGroup === 'Organizations' ? '' : 'Organizations')"
              :active="LinkGroup == 'Organizations' ? true : false" :icon="['fas', 'city']">

            </SidebarGroup>

            <div v-if="LinkGroup == 'Organizations'" @click="LinkGroup = 'Organizations'">

              <SidebarGroupLink :href="route('admin.organizations.regions.index')"
                :active="route().current().includes('admin.organizations.region')">
                Регионы
              </SidebarGroupLink>

              <SidebarGroupLink :href="route('admin.organizations.districts.index')"
                :active="route().current().includes('admin.organizations.district')">
                Округа/Районы
              </SidebarGroupLink>

              <SidebarGroupLink :href="route('admin.organizations.founders.index')"
                :active="route().current().includes('admin.organizations.founder')">
                Учредители
              </SidebarGroupLink>

              <SidebarGroupLink :href="route('admin.organizations.types.index')"
                :active="route().current().includes('admin.organizations.type')">
                Типы
              </SidebarGroupLink>

              <SidebarGroupLink :href="route('admin.organizations.organizations.index')"
                :active="route().current().includes('admin.organizations.organization')">
                Организации
              </SidebarGroupLink>

            </div>
          </div>

          <div v-if="adminPossibilitys.includes('statistics_show')">
            <SidebarGroup :title="'Статистика'" @click="LinkGroup = (LinkGroup === 'Statistics' ? '' : 'Statistics')"
              :active="LinkGroup == 'Statistics' ? true : false" :icon="['fas', 'chart-simple']">
            </SidebarGroup>

            <div v-if="LinkGroup == 'Statistics'" @click="LinkGroup = 'Statistics'">


              <SidebarGroupLink v-if="adminPossibilitys.includes('statistics_mubicipal_admins')"
                :href="route('admin.statistics.municipal.admins.index')"
                :active="route().current().includes('admin.statistics.municipal.admin')">
                Муниципальные координаторы
              </SidebarGroupLink>

              <SidebarGroupLink v-if="adminPossibilitys.includes('statistics_organizations_admins')"
                :href="route('admin.statistics.organizations.admins.index')"
                :active="route().current().includes('admin.statistics.organizations.admin')">
                Руководители организаций
              </SidebarGroupLink>


              <SidebarGroupLink v-if="adminPossibilitys.includes('statistics_organization_info')"
                :href="route('admin.statistics.organizations.organization.info')"
                :active="route().current().includes('admin.statistics.organizations.organization.info')">
                Сведения об организации
              </SidebarGroupLink>


              <SidebarGroupLink v-if="adminPossibilitys.includes('statistics_report_oo2')"
                :href="route('admin.statistics.report.oo2')"
                :active="route().current().includes('admin.statistics.report.oo2')">
                Отчет: ОО-2
              </SidebarGroupLink>

            </div>
          </div>

        </nav>
      </div>
    </aside>

    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <header class="sticky top-0 z-999 flex w-full bg-white drop-shadow dark:bg-boxdark dark:drop-shadow-none">
        <div class="flex flex-grow items-center justify-between py-2 md:px-6 2xl:px-11 lg:justify-end  px-4 ">
          <font-awesome-icon @click="navigationShow = !navigationShow" class="relative flex items-center rounded-sm px-4 py-2 duration-300 ease-in-out border hover:border-viro-main
      lg:hidden" :icon="['fas', 'bars']" />

          <div>
            <p class="mr-4 text-right">{{ $page.props.auth.user.surname }} {{ $page.props.auth.user.name }}
              {{ $page.props.auth.user.patronymic }} (ID{{ $page.props.auth.user.id }})</p>
            <p class="mr-4 text-sm text-right">{{ $page.props.auth.user.viro_dolgnost }}</p>
          </div>

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
