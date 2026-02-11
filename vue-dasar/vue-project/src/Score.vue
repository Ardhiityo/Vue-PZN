<script setup>
import { ref } from "vue";

const score = ref(75);
</script>

<template>
  <div v-if="score >= 75">
    <h3>Yeay, pretty score {{ score }}</h3>
  </div>
  <div v-else-if="score >= 50">
    <h3>Not bad {{ score }}</h3>
  </div>
  <div v-else>
    <h3>Keep it up {{ score }}</h3>
  </div>
</template>