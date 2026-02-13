<script setup>
const [name, nameModifiers] = defineModel("name", {
  required: true,
  type: String,
  get: (value) => {
    if (nameModifiers.uppercase) {
      return value.toUpperCase();
    }
    return value;
  },
});
const email = defineModel("email", {
  required: true,
  type: String,
});
const age = defineModel("age", {
  required: true,
  type: Number,
});
const type = defineModel("type", {
  required: true,
  type: String,
});
const complain = defineModel("complain", {
  required: true,
  type: Boolean,
});
const message = defineModel("message", {
  required: true,
  type: String,
});
</script>

<template>
  <h1>Preview</h1>
  <section>
    <p>Name: {{ name }}</p>
    <p>Email: {{ email }}</p>
    <p>Age: {{ age }}</p>
    <p>Type: {{ type }}</p>
    <p>Complain: {{ complain }}</p>
    <p>Message: {{ message }}</p>
  </section>
</template>