<script setup>
import { ref, watchEffect } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const products = ref([]);

// http://localhost:5173/products/search?product=sony
let keyword = route.query.product || "";

watchEffect(() => {
  fetch("/api/products.json")
    .then((res) => res.json())
    .then((data) => {
      products.value = data.filter((product) =>
        product.name.toLowerCase().includes(keyword.toLowerCase())
      );
    });
});
</script>

<template>
  <h1>Product Search</h1>
  <ul>
    <li v-for="product in products" :key="product.id">
      {{ product.name }} - {{ product.price }}
    </li>
  </ul>
</template>