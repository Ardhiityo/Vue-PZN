<script setup>
import { ref } from "vue";

import About from "./About.vue";
import Contact from "./Contact.vue";
import Blog from "./Blog.vue";

const currentTab = ref("blog");

const tabs = {
  blog: Blog,
  about: About,
  contact: Contact,
};
</script>

<template>
  <h1>Hello Vue!</h1>

  <button @click="currentTab = 'blog'">Blog</button>
  <button @click="currentTab = 'about'">About</button>
  <button @click="currentTab = 'contact'">Contact</button>

  <!-- Component changes when currentTab changes -->
  <component :is="tabs[currentTab]"></component>
</template>