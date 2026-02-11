<script setup>
import { reactive } from "vue";

const person = reactive({
  first_name: "",
  last_name: "",
});

function greet() {
  person.first_name = document.getElementById("first_name").value;
  person.last_name = document.getElementById("last_name").value;
}
</script>
<template>
  <div>
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" />
  </div>
  <div>
    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" />
  </div>
  <button @click="greet">Say Hello</button>
  <h1>Hello {{ person.first_name }} {{ person.last_name }}</h1>
</template>

<style scoped>
</style>