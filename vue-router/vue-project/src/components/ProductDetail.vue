<script setup>
import { ref, watchEffect, defineProps } from "vue";

// Props dikirim dari router (main.js)
const { id } = defineProps({
  id: {
    type: String,
    required: true,
  },
});

const product = ref(null);
const loaded = ref(false);
const error = ref(false);

watchEffect(() => {
  if (id) {
    fetch(`/api/products/${id}.json`)
      .then((response) => response.json())
      .then((data) => {
        product.value = data;
        loaded.value = true;
      })
      .catch((err) => {
        error.value = true;
      });
  }
});
</script>

<template>
  <template v-if="id">
    <div v-if="loaded">
      <h1>Product Detail {{ product.id }}</h1>
      <p>Product Name: {{ product.name }}</p>
      <p>Product Price: {{ product.price }}</p>
    </div>
    <div v-else-if="error">
      <h1>Error loading product {{ id }}</h1>
    </div>
    <div v-else>
      <h1>Loading product {{ id }}</h1>
    </div>
  </template>
  <template v-else>
    <h1>No product id provided</h1>
  </template>
</template>