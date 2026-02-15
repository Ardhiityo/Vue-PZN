<script setup>
import { defineProps } from "vue";

const { requestId } = defineProps(["requestId"]);

console.log(requestId);
</script>

<template>
  <h1>User Profile</h1>
  <p>This is the user profile</p>
  <p>Request ID: {{ requestId }}</p>
</template>