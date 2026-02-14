<script setup>
</script>

<template>
  <h1>Users</h1>
  <p>This is the users header</p>
  <ul>
    <li>
      <RouterLink to="/users">Profile</RouterLink>
    </li>
    <li>
      <RouterLink to="/users/order">Order</RouterLink>
    </li>
    <li>
      <RouterLink to="/users/wishlist">Wishlist</RouterLink>
    </li>
  </ul>
  <RouterView />
  <p>This is the users footer</p>
</template>