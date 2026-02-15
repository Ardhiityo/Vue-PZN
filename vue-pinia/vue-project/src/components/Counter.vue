<script setup>
import { useCounter } from "../store";

const counterStore = useCounter();

counterStore.$subscribe((mutation, state) => {
  console.log(mutation, state);
});
</script>

<template>
  <h1>Counter {{ counterStore.counter }}</h1>
  <button @click="counterStore.increment">Count</button>
  <button @click="counterStore.reset">Reset</button>
</template>
