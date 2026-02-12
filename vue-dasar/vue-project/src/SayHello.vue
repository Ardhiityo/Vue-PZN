<script setup>
import { reactive, ref, computed } from "vue";

const person = reactive({
  first_name: "",
  last_name: "",
});

function greet() {
  person.first_name = document.getElementById("first_name").value;
  person.last_name = document.getElementById("last_name").value;
}

//Tidak akan di proses kembali apabila tidak ada perubahan / tidak akan di re-render
const fullname = computed((oldValue) => {
  console.log("fullName called");
  console.log(oldValue);
  return `${person.first_name} ${person.last_name}`;
});

const counter = ref(0);

//Tidak akan trigger computed apabila computed tidak ada perubahan
function increment() {
  console.log(counter.value);
  counter.value++;
}

function changeFirstName() {
  person.first_name = document.getElementById("first_name").value;
}

function changeLastName() {
  person.last_name = document.getElementById("last_name").value;
}
</script>

<template>
  <!-- Inline statement -->
  <button @click="counter++">Counter {{ counter }}</button>

  <div>
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" @input="changeFirstName" />
  </div>
  <div>
    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" v-on:input="changeLastName" />
  </div>
  <button @click="greet">Say Hello</button>
  <h1>Hello {{ fullname }}</h1>
</template>

<style scoped>
</style>