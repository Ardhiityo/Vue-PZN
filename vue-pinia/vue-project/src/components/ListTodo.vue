<script setup>
import { useTodos } from "../useTodos";

const todolist = useTodos();
</script>

<template>
  <h1>Todolist</h1>

  <h3>
    <RouterLink :to="{ name: 'add-todolist' }">Add</RouterLink>
  </h3>

  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(todo, index) in todolist.todos" :key="todo.id">
        <td>{{ index + 1 }}</td>
        <td>{{ todo.name }}</td>
        <td>
          <button>
            <RouterLink
              :to="{ name: 'update-todolist', params: { id: todo.id } }"
            >
              Edit
            </RouterLink>
          </button>
          <button @click="todolist.remove(Number(todo.id))">Remove</button>
        </td>
      </tr>
    </tbody>
  </table>
  <router-view />
</template>