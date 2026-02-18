<script setup>
import { defineProps, defineEmits } from "vue";

const { contacts } = defineProps({
  contacts: {
    type: Object,
    required: true,
    default: [],
  },
});

defineEmits(["handleDelete"]);
</script>

<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Create New Contact Card -->
    <div
      class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom overflow-hidden border-2 border-dashed border-gray-700 card-hover animate-fade-in"
    >
      <RouterLink
        :to="{ name: 'dashboard.contact.create' }"
        class="block p-6 h-full"
      >
        <div
          class="flex flex-col items-center justify-center h-full text-center"
        >
          <div
            class="w-20 h-20 bg-gradient rounded-full flex items-center justify-center mb-5 shadow-lg transform transition-transform duration-300 hover:scale-110"
          >
            <i class="fas fa-user-plus text-3xl text-white"></i>
          </div>
          <h2 class="text-xl font-semibold text-white mb-3">
            Create New Contact
          </h2>
          <p class="text-gray-300">Add a new contact to your list</p>
        </div>
      </RouterLink>
    </div>

    <!-- Contact Card -->
    <div
      v-for="contact in contacts.data"
      :key="contact.id"
      class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden card-hover animate-fade-in"
    >
      <div class="p-6">
        <a
          href="detail_contact.html"
          class="block cursor-pointer hover:bg-gray-700 rounded-lg transition-all duration-200 p-3"
        >
          <div class="flex items-center mb-3">
            <div
              class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3 shadow-md"
            >
              <i class="fas fa-user text-white"></i>
            </div>
            <h2
              class="text-xl font-semibold text-white hover:text-blue-300 transition-colors duration-200"
            >
              {{ contact.first_name }} {{ contact.last_name }}
            </h2>
          </div>
          <div class="space-y-3 text-gray-300 ml-2">
            <p class="flex items-center">
              <i class="fas fa-user-tag text-gray-500 w-6"></i>
              <span class="font-medium w-24">First Name:</span>
              <span>{{ contact.first_name }}</span>
            </p>
            <p class="flex items-center">
              <i class="fas fa-user-tag text-gray-500 w-6"></i>
              <span class="font-medium w-24">Last Name:</span>
              <span>{{ contact.last_name }}</span>
            </p>
            <p class="flex items-center">
              <i class="fas fa-envelope text-gray-500 w-6"></i>
              <span class="font-medium w-24">Email:</span>
              <span>{{ contact.email }}</span>
            </p>
            <p class="flex items-center">
              <i class="fas fa-phone text-gray-500 w-6"></i>
              <span class="font-medium w-24">Phone:</span>
              <span>{{ contact.phone }}</span>
            </p>
          </div>
        </a>
        <div class="mt-4 flex justify-end space-x-3">
          <RouterLink
            :to="{ name: 'dashboard.contact.edit', params: { id: contact.id } }"
            class="px-4 py-2 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-md flex items-center"
          >
            <i class="fas fa-edit mr-2"></i> Edit
          </RouterLink>
          <button
            @click="$emit('handleDelete', contact.id)"
            class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-md flex items-center"
          >
            <i class="fas fa-trash-alt mr-2"></i> Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>