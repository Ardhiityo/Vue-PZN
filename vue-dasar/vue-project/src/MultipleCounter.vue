<script setup>
import Counter from "./Counter.vue";
</script>

<template>
  <div>
    <h1>Multiple Counter</h1>

    <!-- Walaupun component yang sama tetapi akan terisolasi antar statenya -->
    <Counter name="joko" initial-count="10" />
    <Counter name="joni" initial-count="20" />
  </div>
</template>