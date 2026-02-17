<script setup>
import SearchContact from "../partials/dashboards/SearchContact.vue";
import ContactCard from "../partials/dashboards/ContactCard.vue";
import Pagination from "../partials/Pagination.vue";

import { fetchContact } from "@/lib/api/ContactApi";

import { reactive, ref, onBeforeMount, watch } from "vue";

const queryParams = reactive({
  name: "",
  email: "",
  phone: "",
  page: 1,
});

const meta = reactive({
  currentPage: 1,
  lastPage: 1,
  pages: [],
});

const contacts = ref([]);

onBeforeMount(async () => {
  await getContact();
  for (let i = 1; i <= meta.lastPage; i++) {
    meta.pages.push(i);
  }
});

async function getContact() {
  const response = await fetchContact(queryParams);
  const responseBody = await response.json();

  if (response.status === 200) {
    contacts.value = responseBody;
    meta.lastPage = responseBody.meta.last_page;
    console.log("start 1");
    meta.currentPage = responseBody.meta.current_page;
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

watch(
  // Akses reactive untuk watch perlu function, kecuali ref bisa langsung tanpa function
  () => queryParams.page,
  () => getContact()
);
</script>

<template>
  <section>
    <div class="flex items-center mb-6">
      <i class="fas fa-users text-blue-400 text-2xl mr-3"></i>
      <h1 class="text-2xl font-bold text-white">My Contacts</h1>
    </div>
    <SearchContact v-model="queryParams" @handleSearch="handleSearch" />
    <ContactCard :contacts="contacts" />
    <Pagination
      v-model="meta"
      @previousPage="previousPage"
      @setCurrentPage="setCurrentPage"
      @nextPage="nextPage"
    />
  </section>
</template>