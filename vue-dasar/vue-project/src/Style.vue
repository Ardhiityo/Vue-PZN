<script setup>
import { ref } from "vue";

const am_red = ref(false);
const am_bold = ref(false);

function toggleRed() {
  am_red.value = !am_red.value;
}

function toggleBold() {
  am_bold.value = !am_bold.value;
}
</script>

<template>
  <p :class="{ red: am_red, bold: am_bold }">Hello Vue</p>

  <button @click="toggleRed">Red</button>
  <button @click="toggleBold">Bold</button>

  <h3 :class="['red', 'bold']">Style</h3>
</template>

<style scoped>
.red {
  color: red;
}

.bold {
  text-transform: uppercase;
  font-weight: bold;
}
</style>