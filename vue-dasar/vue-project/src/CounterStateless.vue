<script setup>
import { defineProps } from "vue";

const { name, count } = defineProps(["name", "count"]);
</script>

<template>
  <div>
    <h1>Counter Stateless {{ name }} : {{ count }}</h1>
  </div>
</template>