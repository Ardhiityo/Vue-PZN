<script setup>
import { reactive } from "vue";
import ContactForm from "./ContactForm.vue";

const form = reactive({
  name: "",
  email: "",
  age: "",
  type: "",
  complain: "",
  message: "",
});
</script>

<template>
  <h1>Contact Us</h1>

  <ContactForm v-model="form" />

  <h1>Preview</h1>
  <section>
    <p>Name: {{ form.name }}</p>
    <p>Email: {{ form.email }}</p>
    <p>Age: {{ form.age }}</p>
    <p>Type: {{ form.type }}</p>
    <p>Complain: {{ form.complain }}</p>
    <p>Message: {{ form.message }}</p>
  </section>
</template>