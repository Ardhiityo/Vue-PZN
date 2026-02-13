<script setup>
import { inject } from "vue";

const profile = inject("profile");
</script>

<template>
  <h1>Profile</h1>
  <p>Name : {{ profile.name }}</p>
  <p>Age : {{ profile.age }}</p>
  <p>Address : {{ profile.address }}</p>
</template>