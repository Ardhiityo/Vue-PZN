<script setup>
import { defineModel, defineEmits } from "vue";

const pagination = defineModel();
defineEmits(["nextPage", "previousPage", "setCurrentPage"]);
</script>

<template>
  <div class="mt-10 flex justify-center">
    <nav
      class="flex items-center space-x-3 bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 p-3 animate-fade-in"
    >
      <button
        v-if="pagination.currentPage > 1"
        @click="$emit('previousPage')"
        class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center"
      >
        <i class="fas fa-chevron-left mr-2"></i> Previous
      </button>
      <button
        v-for="page in pagination.pages"
        :key="page"
        @click="$emit('setCurrentPage', page)"
        :class="[
          pagination.currentPage === page
            ? 'px-4 py-2 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-md'
            : 'px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200',
        ]"
      >
        {{ page }}
      </button>
      <button
        v-if="pagination.currentPage < pagination.lastPage"
        @click="$emit('nextPage')"
        class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center"
      >
        Next <i class="fas fa-chevron-right ml-2"></i>
      </button>
    </nav>
  </div>
</template>