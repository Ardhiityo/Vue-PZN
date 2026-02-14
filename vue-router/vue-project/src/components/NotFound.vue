<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
console.log(route);
</script>

<template>
  <h2>404 - Page Not Found</h2>
  <p>The page you are looking for does not exist.</p>
  <p>You tried to access: {{ route.path }}</p>
</template>