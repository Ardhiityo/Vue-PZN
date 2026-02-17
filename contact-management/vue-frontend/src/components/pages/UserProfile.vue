<script setup>
import { onBeforeMount, reactive } from "vue";

import {
  userCurrent,
  userUpdateName,
  userUpdatePassword,
} from "@/lib/api/UserApi";
import { error, success } from "@/lib/alert";

const user = reactive({
  name: "",
  password: "",
  password_confirmation: "",
});

const errors = reactive({
  name: null,
  password: null,
});

onBeforeMount(async () => {
  const response = await userCurrent();
  const responseBody = await response.json();
  if (response.status === 200) {
    user.name = responseBody.data.name;
  }
});

async function handleUpdateName() {
  const response = await userUpdateName(user);
  const responseBody = await response.json();
  if (response.status === 200) {
    user.name = responseBody.data.name;
    success("Yeay, your name updated successfully!");
  } else {
    errors.name = responseBody.name.length ? responseBody.name[0] : null;
    errors.password = responseBody.password.length
      ? responseBody.password[0]
      : null;
  }
}

async function handleUpdatePassword() {
  const response = await userUpdatePassword(user);
  const responseBody = await response.json();
  if (response.status === 200) {
    resetInput();
    resetErrorBag();
    success("Yeay, your password updated successfully!");
  } else {
    errors.password = responseBody.password.length
      ? responseBody.password[0]
      : null;
  }
}

function resetErrorBag() {
  user.name = null;
  user.password = null;
}

function resetInput() {
  user.name = "";
  user.password = "";
  user.password_confirmation = "";
}
</script>

<template>
  <main class="container mx-auto px-4 py-8 flex-grow">
    <div class="flex items-center mb-6">
      <i class="fas fa-user-cog text-blue-400 text-2xl mr-3"></i>
      <h1 class="text-2xl font-bold text-white">My Profile</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Form 1: Edit Name -->
      <div
        class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden card-hover animate-fade-in"
      >
        <div class="p-6">
          <div class="flex items-center mb-4">
            <div
              class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3 shadow-md"
            >
              <i class="fas fa-user-edit text-white"></i>
            </div>
            <h2 class="text-xl font-semibold text-white">Edit Profile</h2>
          </div>
          <form @submit.prevent="handleUpdateName">
            <div class="mb-5">
              <label
                for="name"
                class="block text-gray-300 text-sm font-medium mb-2"
                >Full Name
              </label>
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <i class="fas fa-user text-gray-500"></i>
                </div>
                <input
                  type="text"
                  id="name"
                  name="name"
                  class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                  placeholder="Enter your full name"
                  value="John Doe"
                  required
                  v-model="user.name"
                />
              </div>
              <p v-if="errors.name" class="text-red-500 text-sm font-bold">
                {{ errors.name }}
              </p>
            </div>

            <div class="mt-6">
              <button
                type="submit"
                class="w-full bg-gradient text-white py-3 px-4 rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center"
              >
                <i class="fas fa-save mr-2"></i> Update Profile
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Form 2: Edit Password -->
      <div
        class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden card-hover animate-fade-in"
      >
        <div class="p-6">
          <div class="flex items-center mb-4">
            <div
              class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3 shadow-md"
            >
              <i class="fas fa-key text-white"></i>
            </div>
            <h2 class="text-xl font-semibold text-white">Change Password</h2>
          </div>
          <form @submit.prevent="handleUpdatePassword">
            <div class="mb-5">
              <label
                for="new_password"
                class="block text-gray-300 text-sm font-medium mb-2"
                >New Password</label
              >
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <i class="fas fa-lock text-gray-500"></i>
                </div>
                <input
                  type="password"
                  id="new_password"
                  name="new_password"
                  class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                  placeholder="Enter your new password"
                  required
                  v-model="user.password"
                />
              </div>
              <p v-if="errors.password" class="text-red-500 text-sm font-bold">
                {{ errors.password }}
              </p>
            </div>

            <div class="mb-5">
              <label
                for="confirm_password"
                class="block text-gray-300 text-sm font-medium mb-2"
                >Confirm New Password</label
              >
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <i class="fas fa-check-double text-gray-500"></i>
                </div>
                <input
                  type="password"
                  id="confirm_password"
                  name="confirm_password"
                  class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                  placeholder="Confirm your new password"
                  required
                  v-model="user.password_confirmation"
                />
              </div>
            </div>

            <div class="mt-6">
              <button
                type="submit"
                class="w-full bg-gradient text-white py-3 px-4 rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center"
              >
                <i class="fas fa-key mr-2"></i> Update Password
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
</style>