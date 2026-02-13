<script setup>
import { defineProps } from "vue";

const props = defineProps(["title"]);
</script>

<template>
  <h1>{{ props.title }}</h1>
  <slot> Anda belum memasukkan konten </slot>
</template>