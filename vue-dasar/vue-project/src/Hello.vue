<script setup>
const say = "Hello Vue";
const say_raw = "<h1>Hello Vue Raw</h1>";
</script>

<template>
  <h1 class="h1">{{ say }}</h1>
  <h1 class="h1" v-html="say_raw"></h1>
</template>

<style scoped>
.h1 {
  color: blue;
}
</style>