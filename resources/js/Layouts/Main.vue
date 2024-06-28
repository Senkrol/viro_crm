<script setup>

</script>

<template>
  <Head>
    <meta head-key="description" name="description" content="Default description">
  </Head>
  <div>
    <header>
      <h2>Main</h2>
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