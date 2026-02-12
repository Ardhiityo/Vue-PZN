<script setup>
import { ref } from "vue";

const todos = [
  {
    id: 1,
    task: "Makan",
    done: true,
  },
  {
    id: 2,
    task: "Minum",
    done: false,
  },
  {
    id: 3,
    task: "Belajar",
    done: false,
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

  <!-- List for Range -->
  <ul>
    <li v-for="n in 10" :key="n">Hello, {{ n }}</li>
  </ul>

  <!-- v-for & v-if -->
  <template v-for="(todo, index) in todos" :key="index">
    <ul v-if="!todo.done" :key="todo.id">
      <li v-for="(value, key) in todo" :key="key">{{ key }} : {{ value }}</li>
    </ul>
  </template>
</template>