<script setup>
</script>

<template>
  <h1>Users</h1>
  <RouterView name="header" />
  <!-- Jika tidak memiliki name maka akan menggunakan default -->
  <RouterView v-slot="{ Component }">
    <component :is="Component" :request-id="$route.query.requestId" />
  </RouterView>
  <RouterView name="footer" />
</template>
