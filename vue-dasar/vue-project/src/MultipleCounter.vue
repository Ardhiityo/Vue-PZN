<script setup>
import Counter from "./Counter.vue";
</script>

<template>
  <div>
    <h1>Multiple Counter</h1>

    <!-- Walaupun component yang sama tetapi akan terisolasi antar statenya -->
    <Counter name="joko" />
    <Counter name="joni" />
  </div>
</template>