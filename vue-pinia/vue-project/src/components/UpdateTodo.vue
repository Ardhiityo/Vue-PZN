<script setup>
import { ref, defineProps } from "vue";
import { useTodos } from "../useTodos";
import { useRouter } from "vue-router";

const { id } = defineProps(["id"]);
const todolist = useTodos();

const name = ref(todolist.find(id).name || "");
const router = useRouter();

function updateTodo() {
  todolist.update(id, name.value);
  router.push({
    name: "list-todolist",
  });
}
</script>

<template>
  <h1>Update Todo</h1>
  <h3><RouterLink :to="{ name: 'list-todolist' }">Home</RouterLink></h3>
  <form @submit.prevent="updateTodo">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" v-model="name" />
    <button>Update</button>
  </form>
</template>

