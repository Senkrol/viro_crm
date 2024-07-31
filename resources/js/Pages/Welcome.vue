<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({

});
</script>
<template>

  <Head title="Welcome" />
  <header>

    <div v-if="$page.props.auth.user">
      <Link :href="route('dashboard')">
      Dashboard
      </Link>
    </div>

    <div v-else>
      <Link :href="route('login')">
      Log in
      </Link>

      <Link :href="route('register')">
      Register
      </Link>
      
    </div>

  </header>
</template>
