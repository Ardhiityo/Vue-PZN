<script setup>
import { defineModel } from "vue";

const form = defineModel({
  type: Object,
  required: true,
});
</script>

<template>
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
</template>