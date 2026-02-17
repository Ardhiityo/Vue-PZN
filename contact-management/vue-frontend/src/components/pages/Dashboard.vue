<script setup>
import SearchContact from "../partials/dashboards/SearchContact.vue";
import ContactCard from "../partials/dashboards/ContactCard.vue";
import Pagination from "../partials/Pagination.vue";

import { fetchContact, deleteContact } from "@/lib/api/ContactApi";

import { reactive, ref, onBeforeMount, watch } from "vue";
import { error, success, confirm } from "@/lib/alert";

const queryParams = reactive({
  name: "",
  email: "",
  phone: "",
  page: 1,
});

const pagination = reactive({
  currentPage: 1,
  lastPage: 1,
  pages: [],
});

const contacts = ref([]);

onBeforeMount(async () => {
  await getContact();
  pagination.pages = [];
  for (let i = 1; i <= pagination.lastPage; i++) {
    pagination.pages.push(i);
  }
});

async function getContact() {
  const response = await fetchContact(queryParams);
  const responseBody = await response.json();

  if (response.status === 200) {
    contacts.value = responseBody;
    pagination.lastPage = responseBody.meta.last_page;
    pagination.currentPage = responseBody.meta.current_page;
  } else {
    error(responseBody.errors.token[0]);
  }
}

function nextPage() {
  if (queryParams.page < meta.lastPage) {
    queryParams.page++;
  }
}

function previousPage() {
  if (queryParams.page > 1) {
    queryParams.page--;
  }
}

function setCurrentPage(page) {
  queryParams.page = page;
}

function handleSearch() {
  queryParams.page = 1;
  getContact();
}

// Setiap kali data dihapus maka akan atur ulang pagination & fetchContact ulang
watch(
  () => pagination.lastPage,
  async () => {
    pagination.pages = [];
    for (let i = 1; i <= pagination.lastPage; i++) {
      pagination.pages.push(i);
    }
  }
);

// Setiap kali page berganti maka akan fethContact ulang
watch(
  () => queryParams.page,
  async () => await getContact()
);

async function handleDelete(id) {
  if (await confirm("You won't be able to revert this!")) {
    const response = await deleteContact(Number(id));
    if (response.status === 200) {
      await getContact();
      success("Contact has been deleted!");
    } else {
      error("Ups, something wrong!");
    }
  }
}
</script>

<template>
  <section>
    <div class="flex items-center mb-6">
      <i class="fas fa-users text-blue-400 text-2xl mr-3"></i>
      <h1 class="text-2xl font-bold text-white">My Contacts</h1>
    </div>
    <SearchContact v-model="queryParams" @handleSearch="handleSearch" />
    <ContactCard :contacts="contacts" @handleDelete="handleDelete" />
    <Pagination
      v-model="pagination"
      @previousPage="previousPage"
      @setCurrentPage="setCurrentPage"
      @nextPage="nextPage"
    />
  </section>
</template>