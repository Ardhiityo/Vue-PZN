<script setup>
import { ref } from "vue";

const score = ref(45);
</script>

<template>
  <!-- Element v-show akan selalu ada di DOM, hanya saja di sembunyikan -->
  <h1 v-show="score >= 75">Score : {{ score }}</h1>

  <!-- Element v-if tidak akan ada di DOM jika kondisi false -->
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