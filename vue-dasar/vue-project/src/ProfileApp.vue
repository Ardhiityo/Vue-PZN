<script setup>
import { reactive, provide } from "vue";
import Profile from "./Profile.vue";
import ProfileAddress from "./ProfileAddress.vue";

const profile = reactive({
  name: "John Doe",
  age: 30,
  address: "123 Main St",
});

provide("profile", profile);
</script>

<template>
  <input type="text" name="name" id="name" v-model="profile.name" />
  <input type="text" name="age" id="age" v-model="profile.age" />
  <input type="text" name="address" id="address" v-model="profile.address" />
  <Profile />
  <ProfileAddress />
</template>