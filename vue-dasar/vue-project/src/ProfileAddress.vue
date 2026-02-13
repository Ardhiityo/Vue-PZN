<script setup>
import { inject } from "vue";

const profile = inject("profile");
</script>

<template>
  <h1>Address:</h1>
  <p>{{ profile.address }}</p>
</template>