<script setup>
import { defineProps, defineEmits, defineModel, ref } from 'vue';

const { formTypes, contactId } = defineProps(['formTypes', 'contactId']);
const emit = defineEmits(['create', 'update']);

const contact = defineModel('contact');
const address = defineModel('address');
const errors = defineModel('errors');

function handleSubmit() {
    if (formTypes === 'create') {
        emit('create');
    } else {
        emit('update');
    }
}
</script>

<template>
    <div
        class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden max-w-2xl mx-auto animate-fade-in">
        <div class="p-8">
            <!-- Contact Information -->
            <div class="mb-6 pb-6 border-b border-gray-700">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4 shadow-md">
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

            <form @submit.prevent="handleSubmit">
                <div class="mb-5">
                    <label for="street" class="block text-gray-300 text-sm font-medium mb-2">Street</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-road text-gray-500"></i>
                        </div>
                        <input type="text" id="street" name="street"
                            class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Enter street address" required v-model="address.street" />
                    </div>
                    <p v-if="errors.street" class="text-red-500 text-sm font-bold">
                        {{ errors.street }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="city" class="block text-gray-300 text-sm font-medium mb-2">City</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-city text-gray-500"></i>
                            </div>
                            <input type="text" id="city" name="city"
                                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter city" required v-model="address.city" />
                        </div>
                        <p v-if="errors.city" class="text-red-500 text-sm font-bold">
                            {{ errors.city }}
                        </p>
                    </div>
                    <div>
                        <label for="province"
                            class="block text-gray-300 text-sm font-medium mb-2">Province/State</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map text-gray-500"></i>
                            </div>
                            <input type="text" id="province" name="province"
                                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter province or state" required v-model="address.province" />
                        </div>
                        <p v-if="errors.province" class="text-red-500 text-sm font-bold">
                            {{ errors.province }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label for="country" class="block text-gray-300 text-sm font-medium mb-2">Country</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-flag text-gray-500"></i>
                            </div>
                            <input type="text" id="country" name="country"
                                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter country" required v-model="address.country" />
                        </div>
                        <p v-if="errors.country" class="text-red-500 text-sm font-bold">
                            {{ errors.country }}
                        </p>
                    </div>
                    <div>
                        <label for="postal_code" class="block text-gray-300 text-sm font-medium mb-2">Postal
                            Code</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-mail-bulk text-gray-500"></i>
                            </div>
                            <input type="number" id="postal_code" name="postal_code"
                                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter postal code" required v-model="address.postal_code" />
                        </div>
                        <p v-if="errors.postal_code" class="text-red-500 text-sm font-bold">
                            {{ errors.postal_code }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <RouterLink :to="{
                        name: 'dashboard.contact.detail',
                        params: { id: contactId },
                    }"
                        class="px-5 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center shadow-md">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </RouterLink>
                    <button type="submit"
                        class="px-5 py-3 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>