<script setup>
import { ref, reactive, useTemplateRef } from "vue";

const note = ref("");
const notes = reactive([]);
const inputNote = useTemplateRef("inputNote");
const notesList = useTemplateRef("notesList");

const addNote = () => {
  notes.push(note.value);
  note.value = "";
  inputNote.value.focus();
  if (notesList.value) {
    notesList.value.forEach((li) => {
      console.log(li.textContent);
    });
  }
};
</script>

<template>
  <div>
    <h1>Add Note</h1>
    <form action="" @submit.prevent="addNote">
      <input ref="inputNote" type="text" name="note" id="note" v-model="note" />
      <button type="submit">Add</button>
    </form>
  </div>
  <div>
    <h1>List Notes</h1>
    <ul>
      <li v-for="(note, index) in notes" :key="index" ref="notesList">
        {{ note }}
      </li>
    </ul>
  </div>
</template>