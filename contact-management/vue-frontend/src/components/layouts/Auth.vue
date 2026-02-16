<script setup>
import { defineProps } from "vue";

const { title } = defineProps(["title"]);
</script>

<template>
  <div
    class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex items-center justify-center p-4"
  >
    <div
      class="animate-fade-in bg-gray-800 bg-opacity-80 p-8 rounded-xl shadow-custom border border-gray-700 backdrop-blur-sm w-full max-w-md"
    >
      <div class="text-center mb-8">
        <div class="inline-block p-3 bg-gradient rounded-full mb-4">
          <i class="fas fa-user-plus text-3xl text-white"></i>
        </div>
        <h1 class="text-3xl font-bold text-white">Contact Management</h1>
        <p class="text-gray-300 mt-2">{{ title }}</p>
      </div>
      <slot />
    </div>
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