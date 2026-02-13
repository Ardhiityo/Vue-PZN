<script setup>
import MyButton from "./MyButton.vue";
import Container from "./Container.vue";

function clickHandler() {
  alert("Hello vue!");
}
</script>

<template>
  <!-- Fallthrough Attributes : Khusus single element-->
  <!-- Fallthrough Attributes merupakan attribute atau event listener yang diteruskan oleh Component, tapi tidak secara explicit dideklarasikan menggunakan Props defineProps() atau Event defineEmits(). Contoh misal nya attribute class, style dan id -->
  <MyButton class="btn" @click="clickHandler" name="Eko" contoh="ini contoh" />

  <Container>
    <!-- Jika tidak ada konten yang dimasukkan, maka akan menampilkan konten default dari slot -->

    <!-- Cara 1 dengan # -->
    <template #header>
      <h1>Ini adalah header</h1>
    </template>

    <!-- Cara 2 dengan v-slot -->
    <template v-slot:body>
      <p>Ini adalah body</p>
    </template>

    <!-- Tidak akan ditampilkan karena tidak ada v-if di component Container dengan name slot footer -->
    <!-- <template #footer>
      <p>Ini adalah footer</p>
    </template> -->
  </Container>
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