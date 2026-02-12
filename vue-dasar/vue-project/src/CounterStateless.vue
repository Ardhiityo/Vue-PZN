<script setup>
import { defineProps, defineEmits } from "vue";

const { name, count } = defineProps(["name", "count"]);

//Emit adalah mengirim event dari child ke parent
const emits = defineEmits(["increment"]);
</script>

<template>
  <div>
    <h1>Counter Stateless {{ name }} : {{ count }}</h1>
    <button @click="emits('increment')">Increment {{ name }}</button>
  </div>
</template>