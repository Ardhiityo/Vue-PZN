<script setup>
</script>

<template>
  <div
    class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 p-6 mb-8 animate-fade-in"
  >
    <div class="flex items-center justify-between mb-4">
      <div class="flex items-center">
        <i class="fas fa-search text-blue-400 mr-3"></i>
        <h2 class="text-xl font-semibold text-white">Search Contacts</h2>
      </div>
      <button
        type="button"
        id="toggleSearchForm"
        class="text-gray-300 hover:text-white hover:bg-gray-700 p-2 rounded-full focus:outline-none transition-all duration-200"
      >
        <i class="fas fa-chevron-down text-lg" id="toggleSearchIcon"></i>
      </button>
    </div>
    <div id="searchFormContent" class="mt-4">
      <form>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
          <div>
            <label
              for="search_name"
              class="block text-gray-300 text-sm font-medium mb-2"
              >Name</label
            >
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
              >
                <i class="fas fa-user text-gray-500"></i>
              </div>
              <input
                type="text"
                id="search_name"
                name="search_name"
                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                placeholder="Search by name"
              />
            </div>
          </div>
          <div>
            <label
              for="search_email"
              class="block text-gray-300 text-sm font-medium mb-2"
              >Email</label
            >
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
              >
                <i class="fas fa-envelope text-gray-500"></i>
              </div>
              <input
                type="text"
                id="search_email"
                name="search_email"
                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                placeholder="Search by email"
              />
            </div>
          </div>
          <div>
            <label
              for="search_phone"
              class="block text-gray-300 text-sm font-medium mb-2"
              >Phone</label
            >
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
              >
                <i class="fas fa-phone text-gray-500"></i>
              </div>
              <input
                type="text"
                id="search_phone"
                name="search_phone"
                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                placeholder="Search by phone"
              />
            </div>
          </div>
        </div>
        <div class="mt-5 text-right">
          <button
            type="submit"
            class="px-5 py-3 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5"
          >
            <i class="fas fa-search mr-2"></i> Search
          </button>
        </div>
      </form>
    </div>
  </div>
</template>