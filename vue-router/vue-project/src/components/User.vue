<script setup>
</script>

<template>
  <h1>Users</h1>
  <RouterView name="header" />
  <!-- Jika tidak memiliki name maka akan menggunakan default -->
  <RouterView />
  <RouterView name="footer" />
</template>

