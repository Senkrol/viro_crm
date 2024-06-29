<script setup>

</script>

<template>
  <div>
    <header>
      <h1>Home</h1>
      <nav>
        <div>
          <Link :href="route('home')">Home</Link>
          <Link :href="route('about')">About</Link>
        </div>
      </nav>
    </header>

    <main>
      <slot></slot>
    </main>
  </div>
</template>