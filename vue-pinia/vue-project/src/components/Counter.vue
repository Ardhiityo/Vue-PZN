<script setup>
import { useCounter } from "../store";

const counterStore = useCounter();

function handleClick() {
  counterStore.counter++;
}

counterStore.$subscribe((mutation, state) => {
  console.log(mutation, state);
});

function handleReset() {
  counterStore.$patch({
    counter: 0,
  });
}
</script>

<template>
  <h1>Counter {{ counterStore.counter }}</h1>
  <button @click="handleClick">Count</button>
  <button @click="handleReset">Reset</button>
</template>
