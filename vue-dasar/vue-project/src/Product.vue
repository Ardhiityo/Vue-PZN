<script setup>
import { onWatcherCleanup, ref, watch, watchEffect } from "vue";

const product_id = ref("product1");
const product = ref(null);

/**
 watch(
   product_id,
   async (new_value, old_value) => {
     console.log("watch called");
     const response = await fetch(`/${new_value}.json`);
     product.value = await response.json();
   },
   {
     immediate: true, //watch akan dijalankan segera ketika component di-mount
     //once: true, //watch hanya dijalankan satu kali setelah melakukan perubahan
   }
 );
 */

//watchEffect akan dijalankan segera ketika component di-mount (immediate = true secara default)
//akan otomatis track state yang ada di dalam watchEffect
watchEffect(async () => {
  //untuk membersihkan state ketika sebelum terjadi perubahan
  onWatcherCleanup(() => {
    console.log("Cleanup");
  });

  console.log("watchEffect called");
  if (product_id.value) {
    const response = await fetch(`/${product_id.value}.json`);
    product.value = await response.json();
  } else {
    product.value = null;
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