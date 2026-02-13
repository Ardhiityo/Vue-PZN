<script setup>
import { useSlots } from "vue";

const slots = useSlots();
</script>

<template>
  <!-- v-if="slots.header" digunakan untuk mengecek apakah slot header ada atau tidak, jika ada maka akan menampilkan konten header, jika tidak ada maka tidak akan menampilkan slot header, bahkan defaultnya pun tidak akan ditampilkan -->
  <div v-if="slots.header">
    <slot name="header">
      <!-- Jika slot ada maka akan menampilkan konten slot, jika tidak ada maka akan menampilkan konten default -->
      Anda belum memasukkan konten header
    </slot>
  </div>

  <div v-if="slots.body">
    <slot name="body">Anda belum memasukkan konten body</slot>
  </div>

  <div v-if="slots.footer">
    <slot name="footer">Anda belum memasukkan konten footer</slot>
  </div>
</template>