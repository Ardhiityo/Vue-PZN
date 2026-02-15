<script setup>
import { useCounter } from "../store";

const counterStore = useCounter();

function handleClick() {
  counterStore.counter++;
}
</script>

<template>
  <h1>Counter {{ counterStore.counter }}</h1>
  <button @click="handleClick">Count</button>
</template>
