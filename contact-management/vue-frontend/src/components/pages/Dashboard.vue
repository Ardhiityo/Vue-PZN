<script setup>
import Main from "../layouts/Main.vue";
import SearchContact from "../partials/contacts/SearchContact.vue";
import ContactCard from "../partials/contacts/ContactCard.vue";
import Pagination from "../partials/Pagination.vue";
</script>

<template>
  <Main>
    <div class="flex items-center mb-6">
      <i class="fas fa-users text-blue-400 text-2xl mr-3"></i>
      <h1 class="text-2xl font-bold text-white">My Contacts</h1>
    </div>
    <SearchContact />
    <ContactCard />
    <Pagination />
  </Main>
</template>