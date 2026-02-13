<script setup>
import { reactive } from "vue";
import ContactForm from "./ContactForm.vue";
import ContactList from "./ContactList.vue";

const form = reactive({
  name: "",
  email: "",
  age: 0,
  type: "",
  complain: false,
  message: "",
});
</script>

<template>
  <h1>Contact Us</h1>

  <ContactForm v-model="form" />
  <ContactList
    v-model:name.uppercase="form.name"
    v-model:email="form.email"
    v-model:age="form.age"
    v-model:type="form.type"
    v-model:complain="form.complain"
    v-model:message="form.message"
  />
</template>