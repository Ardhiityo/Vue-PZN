<script setup>
import { useRoute } from "vue-router";
import { ref, watchEffect } from "vue";

const route = useRoute();

const product = ref(null);
const loaded = ref(false);
const error = ref(false);

watchEffect(() => {
  if (route.params.id) {
    fetch(`/api/products/${route.params.id}.json`)
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
  <template v-if="route.params.id">
    <div v-if="loaded">
      <h1>Product Detail {{ product.id }}</h1>
      <p>Product Name: {{ product.name }}</p>
      <p>Product Price: {{ product.price }}</p>
    </div>
    <div v-else-if="error">
      <h1>Error loading product {{ route.params.id }}</h1>
    </div>
    <div v-else>
      <h1>Loading product {{ route.params.id }}</h1>
    </div>
  </template>
  <template v-else>
    <h1>No product id provided</h1>
  </template>
</template>