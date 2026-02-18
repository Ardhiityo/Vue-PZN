<script setup>
import { error, success } from "@/lib/alert";
import { detailAddress, updateAddress } from "@/lib/api/AddressApi";
import { detailContact } from "@/lib/api/ContactApi";
import { onBeforeMount, reactive } from "vue";
import { useRoute } from "vue-router";
import AddressForm from "@/components/partials/addresses/AddressForm.vue";

const route = useRoute();

const contactId = route.params.id;
const addressId = route.params.addressId;

onBeforeMount(async () => {
  await getContact();
  await getAddress();
});

const contact = reactive({
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
});

const address = reactive({
  street: "",
  city: "",
  country: "",
  province: "",
  postal_code: "",
});

const errors = reactive({
  street: "",
  city: "",
  country: "",
  province: "",
  postal_code: "",
});

async function getContact() {
  const response = await detailContact(contactId);
  const responseBody = await response.json();
  if (response.status === 200) {
    contact.first_name = responseBody.data.first_name;
    contact.last_name = responseBody.data.last_name;
    contact.email = responseBody.data.email;
    contact.phone = responseBody.data.phone;
  } else {
    error("Ups, something wrong!");
  }
}

async function getAddress() {
  const response = await detailAddress(contactId, addressId);
  const responseBody = await response.json();

  if (response.status === 200) {
    address.street = responseBody.data.street;
    address.city = responseBody.data.city;
    address.country = responseBody.data.country;
    address.province = responseBody.data.province;
    address.postal_code = responseBody.data.postal_code;
  } else {
    error("Ups, something wrong!");
  }
}

async function handleUpdate() {
  const response = await updateAddress(contactId, addressId, address);
  const responseBody = await response.json();

  if (response.status === 200) {
    resetErrorBag();
    success("Yeay, address updated successfuly!");
  } else {
    errors.street = responseBody?.street?.length
      ? responseBody?.street[0]
      : null;
    errors.city = responseBody?.city?.length ? responseBody?.city[0] : null;
    errors.country = responseBody?.country?.length
      ? responseBody?.country[0]
      : null;
    errors.province = responseBody?.province?.length
      ? responseBody?.province[0]
      : null;
    errors.postal_code = responseBody?.postal_code?.length
      ? responseBody?.postal_code[0]
      : null;
  }
}

function resetInput() {
  address.street = "";
  address.city = "";
  address.country = "";
  address.province = "";
  address.postal_code = "";
}

function resetErrorBag() {
  errors.street = "";
  errors.city = "";
  errors.country = "";
  errors.phone = "";
  errors.province = "";
  errors.postal_code = "";
}
</script>

<template>
  <section>
    <div class="flex items-center mb-6">
      <RouterLink :to="{ name: 'dashboard.contact.detail', params: { id: contactId } }"
        class="text-blue-400 hover:text-blue-300 mr-4 flex items-center transition-colors duration-200">
        <i class="fas fa-arrow-left mr-2"></i> Back to Contact Details
      </RouterLink>
      <h1 class="text-2xl font-bold text-white flex items-center">
        <i class="fas fa-map-marker-alt text-blue-400 mr-3"></i> Edit Address
      </h1>
    </div>
    <AddressForm :formTypes="'update'" @update="handleUpdate" v-model:contact="contact" v-model:address="address"
      :contactId="contactId" v-model:errors="errors" />
  </section>
</template>