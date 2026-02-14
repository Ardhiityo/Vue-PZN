<script setup>
</script>

<template>
  <h1>Users</h1>
  <p>This is the users header</p>
  <ul>
    <li>
      <RouterLink :to="{ name: 'user-profile' }">Profile</RouterLink>
    </li>
    <li>
      <RouterLink :to="{ name: 'user-order' }">Order</RouterLink>
    </li>
    <li>
      <RouterLink :to="{ name: 'user-wishlist' }">Wishlist</RouterLink>
    </li>
  </ul>
  <RouterView />
  <p>This is the users footer</p>
</template>

<style scoped>
.router-link-exact-active {
  color: red;
  font-weight: bold;
}
</style>