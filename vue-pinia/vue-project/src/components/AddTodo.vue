<script setup>
import { ref } from "vue";
import { useTodos } from "../useTodos";
import { useRouter } from "vue-router";

const todolist = useTodos();

const name = ref("");

const router = useRouter();

function addTodo(name) {
  todolist.add(name);
  router.push("/todolist");
}
</script>

<template>
  <h1>Add Todo</h1>
  <h3><RouterLink :to="{ name: 'list-todolist' }">Home</RouterLink></h3>
  <form @submit.prevent="addTodo(name)">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" v-model="name" />
    <button>Add</button>
  </form>
</template>

