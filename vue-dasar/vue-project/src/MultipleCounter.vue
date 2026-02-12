<script setup>
import { ref } from "vue";

import Counter from "./Counter.vue";
import CounterStateless from "./CounterStateless.vue";

const count = ref(0);

//Mengirim event ke child dengan emit
const increment = () => {
  count.value++;
};
</script>

<template>
  <div>
    <h1>Multiple Counter</h1>

    <!-- Walaupun component yang sama tetapi akan terisolasi antar statenya -->
    <Counter name="joko" initial-count="10" />
    <Counter name="joni" initial-count="20" />

    <!-- Emit cara 1 -->
    <CounterStateless name="andre" :count="count" @increment="increment" />

    <!-- Emit cara 2 -->
    <CounterStateless
      name="andra"
      :count="count"
      @increment="() => (count += 2)"
    />
    <button @click="increment">Increment</button>
  </div>
</template>