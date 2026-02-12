<script setup>
import { ref } from "vue";

import Counter from "./Counter.vue";
import CounterStateless from "./CounterStateless.vue";

const count = ref(0);
</script>

<template>
  <div>
    <h1>Multiple Counter</h1>

    <!-- Walaupun component yang sama tetapi akan terisolasi antar statenya -->
    <Counter name="joko" initial-count="10" />
    <Counter name="joni" initial-count="20" />

    <CounterStateless name="andre" :count="count" />
    <CounterStateless name="andra" :count="count" />
    <button @click="count++">Increment</button>
  </div>
</template>