<script setup>
import { ref, watchEffect, defineProps } from "vue";
import { useRouter } from "vue-router";

const products = ref([]);
const router = useRouter();

// Props dikirim dari router (main.js)
const { product } = defineProps(["product"]);

// http://localhost:5173/products/search?product=sony
const query = ref(product || "");

watchEffect(() => {
  // push : menambah history setiap kali di panggil (banyak history)
  // router.push({
  //   query: {
  //     product: query.value,
  //   },
  // });
  // replace : mengganti history setiap kali di panggil (satu history)
  router.replace({
    name: "product-search",
    query: {
      product: query.value,
    },
  });
  fetch("/api/products.json")
    .then((res) => res.json())
    .then((data) => {
      products.value = data.filter((product) =>
        product.name.toLowerCase().includes(query.value.toLowerCase())
      );
    });
});
</script>

<template>
  <h1>Product Search</h1>
  <form action="">
    <label for="keyword">Keyword</label>
    <input type="text" name="keyword" id="keyword" v-model="query" />
  </form>
  <ul>
    <li v-for="product in products" :key="product.id">
      {{ product.name }} - {{ product.price }}
    </li>
  </ul>
</template>