<script setup>
import { ref, nextTick, defineProps } from "vue";

// Simple Reactive State
// const count = ref(0);
// function increment() {
//   count.value++;
// }

const props = defineProps(["name", "initialCount"]);

// Object Reactive State
const counter = ref({
  name: "Budi",
  count: props.initialCount,
});

async function increment() {
  console.log(counter.value.count); //0

  counter.value.count++;
  await nextTick();
  //memastikan kode berjalan setelah terupdate.
  console.log(counter.value.count); //1

  counter.value.count++;
  await nextTick();
  //memastikan kode berjalan setelah terupdate.
  console.log(counter.value.count); //2

  counter.value.count++;
  await nextTick();
  //memastikan kode berjalan setelah terupdate.
  console.log(counter.value.count); //3
}
</script>

<template>
  <!-- Reactive State -->
  <h1>Counter {{ props.name }} : {{ counter.count }}</h1>

  <!-- Cara 1 -->
  <!-- <button @click="increment">Tambah</button> -->

  <!-- Cara 2 -->
  <button v-on:click="increment">Tambah</button>
</template>

<style scoped>
</style>