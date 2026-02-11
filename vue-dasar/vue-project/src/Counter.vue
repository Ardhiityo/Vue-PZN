<script setup>
import { ref } from "vue";

const count = ref(0);

function increment() {
  count.value++;
}
</script>

<template>
  <!-- Reactive State -->
  <h1>{{ count }}</h1>

  <!-- Cara 1 -->
  <!-- <button @click="increment">Tambah</button> -->

  <!-- Cara 2 -->
  <button v-on:click="increment">Tambah</button>
</template>

<style scoped>
</style>