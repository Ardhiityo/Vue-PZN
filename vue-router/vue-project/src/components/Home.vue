<script setup>
const { title } = defineProps({
  title: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <h1>{{ title }}</h1>
  <p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.
  </p>
</template>