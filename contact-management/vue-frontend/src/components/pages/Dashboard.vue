<script setup>
import SearchContact from "../partials/dashboards/SearchContact.vue";
import ContactCard from "../partials/dashboards/ContactCard.vue";
import Pagination from "../partials/Pagination.vue";
</script>

<template>
  <section>
    <div class="flex items-center mb-6">
      <i class="fas fa-users text-blue-400 text-2xl mr-3"></i>
      <h1 class="text-2xl font-bold text-white">My Contacts</h1>
    </div>
    <SearchContact />
    <ContactCard />
    <Pagination />
  </section>
</template>