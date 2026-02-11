<script setup>
import { ref } from "vue";

const todos = [
  {
    id: 1,
    task: "Makan",
  },
  {
    id: 2,
    task: "Minum",
  },
  {
    id: 3,
    task: "Belajar",
  },
];
</script>

<template>
  <h1>Todolist</h1>

  <!-- Cara 1 : Looping array -->
  <!-- <ul>
    <li v-for="(todo, index) in todos" :key="index">
      {{ index }} {{ todo.task }}
    </li>
  </ul> -->

  <!-- Cara 2 : Looping object -->
  <ul v-for="(todo, index) in todos" :key="index">
    <li v-for="(value, key) in todo" :key="key">{{ key }} : {{ value }}</li>
  </ul>
</template>