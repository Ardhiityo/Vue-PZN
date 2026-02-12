<script setup>
import { ref, watch } from "vue";

const product_id = ref("");
const product = ref(null);

watch(product_id, async (new_value, old_value) => {
  if (new_value) {
    const response = await fetch(`/${new_value}.json`);
    product.value = await response.json();
  }
});
</script>

<template>
  <div>
    <label for="product">Product</label>
    <select name="product" id="product" v-model="product_id" required>
      <option value="">Select product</option>
      <option value="product1">Product 1</option>
      <option value="product2">Product 2</option>
      <option value="product3">Product 3</option>
    </select>
  </div>

  <template v-if="product">
    <p>Selected product:</p>
    <ul>
      <li>{{ product.id }}</li>
      <li>{{ product.name }}</li>
      <li>{{ product.price }}</li>
    </ul>
  </template>
</template>