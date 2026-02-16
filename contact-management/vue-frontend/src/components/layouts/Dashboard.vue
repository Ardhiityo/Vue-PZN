<script setup>
import Header from "../partials/Header.vue";
import Footer from "../partials/Footer.vue";
</script>

<template>
  <div
    class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex flex-col"
  >
    <Header />
    <main class="container mx-auto px-4 py-8 flex-grow">
      <RouterView />
      <Footer />
    </main>
  </div>
</template>

<style scoped>
</style>