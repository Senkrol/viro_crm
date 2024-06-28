<script setup>

</script>

<template>
  <div>
    <header>
      <h1>Home</h1>
      <nav>
        <div>
          <Link href="/">Home</Link>
          <Link href="/about">About</Link>
        </div>
      </nav>
    </header>

    <main>
      <slot></slot>
    </main>
  </div>
</template>