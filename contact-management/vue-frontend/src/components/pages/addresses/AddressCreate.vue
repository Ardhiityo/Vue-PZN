<script setup>
import { onBeforeMount, reactive } from "vue";
import { useRoute, useRouter } from "vue-router";
import { detailContact } from "@/lib/api/ContactApi";
import { createAddress } from "@/lib/api/AddressApi";
import { success, error } from "@/lib/alert";

const route = useRoute();
const router = useRouter();

const contactId = route.params.id;

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

onBeforeMount(async () => {
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
});

async function handleCreateAddress() {
  const response = await createAddress(contactId, address);
  const responseBody = await response.json();
  if (response.status === 201) {
    resetErrorBag();
    resetInput();
    router.push({
      name: "dashboard.contact.detail",
      params: { id: contactId },
    });
    success("Yeay, address created successfuly!");
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
      <a
        href="detail_contact.html"
        class="text-blue-400 hover:text-blue-300 mr-4 flex items-center transition-colors duration-200"
      >
        <i class="fas fa-arrow-left mr-2"></i> Back to Contact Details
      </a>
      <h1 class="text-2xl font-bold text-white flex items-center">
        <i class="fas fa-plus-circle text-blue-400 mr-3"></i> Add New Address
      </h1>
    </div>

    <div
      class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden max-w-2xl mx-auto animate-fade-in"
    >
      <div class="p-8">
        <!-- Contact Information -->
        <div class="mb-6 pb-6 border-b border-gray-700">
          <div class="flex items-center">
            <div
              class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4 shadow-md"
            >
              <i class="fas fa-user text-white"></i>
            </div>
            <div>
              <h2 class="text-xl font-semibold text-white">
                {{ contact.first_name }} {{ contact.last_name }}
              </h2>
              <p class="text-gray-300 text-sm">
                {{ contact.email }} • {{ contact.phone }}
              </p>
            </div>
          </div>
        </div>

        <form @submit.prevent="handleCreateAddress">
          <div class="mb-5">
            <label
              for="street"
              class="block text-gray-300 text-sm font-medium mb-2"
              >Street</label
            >
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
              >
                <i class="fas fa-road text-gray-500"></i>
              </div>
              <input
                type="text"
                id="street"
                name="street"
                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                placeholder="Enter street address"
                required
                v-model="address.street"
              />
            </div>
            <p v-if="errors.street" class="text-red-500 text-sm font-bold">
              {{ errors.street }}
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
            <div>
              <label
                for="city"
                class="block text-gray-300 text-sm font-medium mb-2"
                >City</label
              >
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <i class="fas fa-city text-gray-500"></i>
                </div>
                <input
                  type="text"
                  id="city"
                  name="city"
                  class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                  placeholder="Enter city"
                  required
                  v-model="address.city"
                />
              </div>
              <p v-if="errors.city" class="text-red-500 text-sm font-bold">
                {{ errors.city }}
              </p>
            </div>
            <div>
              <label
                for="province"
                class="block text-gray-300 text-sm font-medium mb-2"
                >Province/State</label
              >
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <i class="fas fa-map text-gray-500"></i>
                </div>
                <input
                  type="text"
                  id="province"
                  name="province"
                  class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                  placeholder="Enter province or state"
                  required
                  v-model="address.province"
                />
              </div>
              <p v-if="errors.province" class="text-red-500 text-sm font-bold">
                {{ errors.province }}
              </p>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
            <div>
              <label
                for="country"
                class="block text-gray-300 text-sm font-medium mb-2"
                >Country</label
              >
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <i class="fas fa-flag text-gray-500"></i>
                </div>
                <input
                  type="text"
                  id="country"
                  name="country"
                  class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                  placeholder="Enter country"
                  required
                  v-model="address.country"
                />
              </div>
              <p v-if="errors.country" class="text-red-500 text-sm font-bold">
                {{ errors.country }}
              </p>
            </div>
            <div>
              <label
                for="postal_code"
                class="block text-gray-300 text-sm font-medium mb-2"
                >Postal Code</label
              >
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <i class="fas fa-mail-bulk text-gray-500"></i>
                </div>
                <input
                  type="number"
                  id="postal_code"
                  name="postal_code"
                  class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                  placeholder="Enter postal code"
                  required
                  v-model="address.postal_code"
                />
              </div>
              <p
                v-if="errors.postal_code"
                class="text-red-500 text-sm font-bold"
              >
                {{ errors.postal_code }}
              </p>
            </div>
          </div>

          <div class="flex justify-end space-x-4">
            <RouterLink
              :to="{
                name: 'dashboard.contact.detail',
                params: { id: contactId },
              }"
              class="px-5 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center shadow-md"
            >
              <i class="fas fa-times mr-2"></i> Cancel
            </RouterLink>
            <button
              type="submit"
              class="px-5 py-3 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center"
            >
              <i class="fas fa-plus-circle mr-2"></i> Add Address
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>