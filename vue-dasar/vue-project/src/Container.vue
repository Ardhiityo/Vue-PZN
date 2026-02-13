<script setup>
import { useSlots, ref } from "vue";

const slots = useSlots();
const count = ref(0);
</script>

<template>
  <!-- v-if="slots.header" digunakan untuk mengecek apakah slot header ada atau tidak, jika ada maka akan menampilkan konten header, jika tidak ada maka tidak akan menampilkan slot header, bahkan defaultnya pun tidak akan ditampilkan -->
  <div v-if="slots.header">
    <!-- :count="count" digunakan untuk mengirimkan data dari component slot Container (parent) ke component ButtonApp (child) -->
    <slot name="header" :count="count">
      <!-- Jika slot ada maka akan menampilkan konten slot, jika tidak ada maka akan menampilkan konten default -->
      Anda belum memasukkan konten header
    </slot>
  </div>

  <div v-if="slots.body" :count="count">
    <slot name="body">Anda belum memasukkan konten body</slot>
  </div>

  <div v-if="slots.footer" :count="count">
    <slot name="footer">Anda belum memasukkan konten footer</slot>
  </div>

  <button @click="count++">Increment {{ count }}</button>
</template>