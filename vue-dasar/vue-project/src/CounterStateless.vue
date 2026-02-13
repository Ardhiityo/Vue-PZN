<script setup>
import { defineProps } from "vue";

const { name, count, increment } = defineProps({
  name: String,
  count: Number,
  increment: Number,
});
</script>

<template>
  <div>
    <h1>Counter Stateless {{ name }} : {{ count }}</h1>
    <button @click="$emit('increment', increment)">Increment {{ name }}</button>
  </div>
</template>