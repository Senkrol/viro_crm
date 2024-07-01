<script setup>

</script>

<template>

  <Head>
    <meta head-key="description" name="description" content="Default description">
  </Head>
  <div>
    <header>
      <nav>
        <div class="space-x-6">
          <!-- <Link ... preserve-scroll ...>  остаемся на том же месте прокрутки страницы-->
          <Link :href="route('home')" class="nav-link">Home</Link>
        </div>
        <div class="space-x-6">
          <!-- <Link ... preserve-scroll ...>  остаемся на том же месте прокрутки страницы-->
            <Link :href="route('register')" class="nav-link">Register</Link>
        </div>
        
      </nav>
    </header>

    <main class="p-4">
      <slot></slot>
    </main>
  </div>
</template>