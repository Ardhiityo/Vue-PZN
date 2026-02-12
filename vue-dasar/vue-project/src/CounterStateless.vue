<script setup>
import { defineProps, defineEmits } from "vue";

const { name, count, increment } = defineProps({
  name: String,
  count: Number,
  increment: Number,
});

//Emit adalah mengirim event dari child ke parent
const emits = defineEmits(["increment"]);
</script>

<template>
  <div>
    <h1>Counter Stateless {{ name }} : {{ count }}</h1>
    <button @click="emits('increment', increment)">Increment {{ name }}</button>
  </div>
</template>