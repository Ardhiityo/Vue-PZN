<script setup>
import MyButton from "./MyButton.vue";

function clickHandler() {
  alert("Hello vue!");
}
</script>

<template>
  <!-- Fallthrough Attributes : Khusus single element-->
  <!-- Fallthrough Attributes merupakan attribute atau event listener yang diteruskan oleh Component, tapi tidak secara explicit dideklarasikan menggunakan Props defineProps() atau Event defineEmits(). Contoh misal nya attribute class, style dan id -->
  <MyButton class="btn" @click="clickHandler" name="Eko" contoh="ini contoh" />
</template>

<style scoped>
.btn {
  background-color: blue;
  color: white;
  padding: 10px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}
</style>