<script setup>
import { reactive } from "vue";

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

  <section>
    <form action="">
      <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" v-model="form.name" required />
      </div>

      <div>
        <label for="email">Email</label>
        <input
          type="email"
          name="email"
          id="email"
          v-model="form.email"
          required
        />
      </div>

      <div>
        <label for="age">Age</label>
        <input type="number" name="age" id="age" v-model="form.age" required />
      </div>

      <div>
        <label for="type">Type</label>
        <select name="type" id="type" v-model="form.type" required>
          <option value="">Select option</option>
          <option value="regular">Regular</option>
          <option value="vip">VIP</option>
        </select>
      </div>

      <div>
        <label for="complain">Complain</label>
        <input
          type="checkbox"
          name="complain"
          id="complain"
          v-model="form.complain"
          required
        />
      </div>

      <div>
        <label for="message">Message</label>
        <textarea
          name="message"
          id="message"
          v-model="form.message"
          required
        ></textarea>
      </div>

      <button @click.prevent="" type="submit">Submit</button>
    </form>
  </section>

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