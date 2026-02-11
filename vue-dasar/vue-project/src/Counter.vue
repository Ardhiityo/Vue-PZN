<script setup>
import { ref } from "vue";

// Simple Reactive State
// const count = ref(0);
// function increment() {
//   count.value++;
// }

// Object Reactive State
const counter = ref({
  name: "Budi",
  count: 0,
});

function increment() {
  counter.value.count++;
}
</script>

<template>
  <!-- Reactive State -->
  <h1>Counter {{ counter.name }} : {{ counter.count }}</h1>

  <!-- Cara 1 -->
  <!-- <button @click="increment">Tambah</button> -->

  <!-- Cara 2 -->
  <button v-on:click="increment">Tambah</button>
</template>

<style scoped>
</style>