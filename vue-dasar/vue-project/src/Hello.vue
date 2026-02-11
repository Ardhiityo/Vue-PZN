<script setup>
const say = "Hello Vue";
const say_raw = "<h1>Hello Vue Raw</h1>";
const h1 = "h1";

const show_disabled = true;

const data = {
  id: "h1",
  class: "h1",
};
</script>

<template>
  <h1 class="h1">{{ say }}</h1>
  <h1 class="h1" v-html="say_raw"></h1>

  <!-- Cara 1 -->
  <h1 v-bind:id="h1" v-bind:class="h1">Hello Vue Class</h1>
  <!-- Cara 2 -->
  <h1 :id="h1" :class="h1">Hello Vue Class</h1>

  <button :disabled="show_disabled">Button</button>

  <!-- Multiple Attributes -->
  <h1 v-bind="data">{{ say }}</h1>
  <h1 :class="data.class">{{ say }}</h1>
</template>

<style scoped>
.h1 {
  color: blue;
}
</style>