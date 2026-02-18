<script setup>
import { reactive } from "vue";
import { createContact } from "@/lib/api/ContactApi";
import { success } from "@/lib/alert";
import ContactForm from "@/components/partials/contacts/ContactForm.vue";

const contact = reactive({
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
});

const errors = reactive({
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
});

async function handleCreate() {
  const response = await createContact(contact);
  const responseBody = await response.json();
  if (response.status === 201) {
    resetInput();
    resetErrorBag();
    success("Yeay, contact created successfuly!");
  } else {
    errors.first_name = responseBody?.first_name?.length
      ? responseBody?.first_name[0]
      : null;
    errors.last_name = responseBody?.last_name?.length
      ? responseBody?.last_name[0]
      : null;
    errors.email = responseBody?.email?.length ? responseBody?.email[0] : null;
    errors.phone = responseBody?.phone?.length ? responseBody?.phone[0] : null;
  }
}

function resetErrorBag() {
  errors.first_name = "";
  errors.last_name = "";
  errors.email = "";
  errors.phone = "";
}

function resetInput() {
  contact.first_name = "";
  contact.last_name = "";
  contact.email = "";
  contact.phone = "";
}
</script>

<template>
  <section>
    <div class="flex items-center mb-6">
      <RouterLink :to="{ name: 'dashboard' }"
        class="text-blue-400 hover:text-blue-300 mr-4 flex items-center transition-colors duration-200">
        <i class="fas fa-arrow-left mr-2"></i> Back to Contacts
      </RouterLink>
      <h1 class="text-2xl font-bold text-white flex items-center">
        <i class="fas fa-user-plus text-blue-400 mr-3"></i> Create New Contact
      </h1>
    </div>
    <ContactForm :formTypes="'create'" @create="handleCreate" v-model:contact="contact" v-model:errors="errors" />
  </section>
</template>