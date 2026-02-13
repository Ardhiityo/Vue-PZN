<script setup>
import { useAttrs, defineProps } from "vue";

defineOptions({
  // Menonaktifkan Fallthrough Attributes
  //   inheritAttrs: false,
});

// Jika attribute dideklarasikan menggunakan defineProps, maka attribute tersebut tidak akan masuk ke useAttrs
//Disarankan menggunakan props walaupun hanya 1 element
const props = defineProps(["contoh"]);
console.log(props);
//Proxy(Object) {contoh: 'ini contoh'}

// Jika attribute tidak dideklarasikan menggunakan defineProps, maka akan masuk ke useAttrs
const attrs = useAttrs();
console.log(attrs);
//Proxy(Object) {class: 'btn', name: 'Eko', onClick: ƒ}
</script>

<template>
  <!-- Khusus single element -->
  <button>My Button : {{ attrs.name }}</button>
</template>

<style scoped>
</style>