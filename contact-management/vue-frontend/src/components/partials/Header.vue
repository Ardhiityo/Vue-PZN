<script setup>
</script>

<template>
  <header class="bg-gradient shadow-lg">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <a
        href="dashboard.html"
        class="flex items-center hover:opacity-90 transition-opacity duration-200"
      >
        <i class="fas fa-address-book text-white text-2xl mr-3"></i>
        <div class="text-white font-bold text-xl">Contact Management</div>
      </a>
      <nav>
        <ul class="flex space-x-6">
          <li>
            <a
              href="profile.html"
              class="text-gray-100 hover:text-white flex items-center transition-colors duration-200"
            >
              <i class="fas fa-user-circle mr-2"></i>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <a
              href="index.html"
              class="text-gray-100 hover:text-white flex items-center transition-colors duration-200"
            >
              <i class="fas fa-sign-out-alt mr-2"></i>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>