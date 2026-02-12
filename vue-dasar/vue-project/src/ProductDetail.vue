<script setup>
import { defineProps } from "vue";

const props = defineProps({
  id: {
    type: Number,
    required: true,
  },
  name: {
    type: String,
    required: true,
    validator: (value, props) => {
      return value.trim().length > 0;
    },
  },
  price: {
    type: Number,
    required: true,
    validator: (value, props) => {
      return value > 0;
    },
  },
});
</script>

<template>
  <ul>
    <li>{{ props.id }}</li>
    <li>{{ props.name }}</li>
    <li>{{ props.price }}</li>
  </ul>
</template>