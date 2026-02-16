<script setup>
import Header from "../partials/Header.vue";
import Footer from "../partials/Footer.vue";
</script>

<template>
  <div
    class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex flex-col"
  >
    <!-- Header with right-aligned menu -->
    <Header />

    <!-- Main content -->
    <main class="container mx-auto px-4 py-8 flex-grow">
      <slot />
      <Footer />
    </main>
  </div>
</template>

<style scoped>
.bg-gradient {
  background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
}
.animate-fade-in {
  animation: fadeIn 0.5s ease-in-out;
}
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.card-hover {
  transition: all 0.3s ease;
}
.card-hover:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.3);
}
</style>