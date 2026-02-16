<script setup>
import { reactive } from "vue";
import { userRegister } from "@/lib/api/UserApi";
import { success } from "@/lib/alert";
import { useRouter } from "vue-router";

const user = reactive({
  username: "",
  name: "",
  password: "",
  password_confirmation: "",
});

const errors = reactive({
  name: null,
  username: null,
  password: null,
});

const router = useRouter();

async function handleRegister() {
  const response = await userRegister(user);
  const responseBody = await response.json();

  if (response.status === 201) {
    resetInput();
    resetErrorBag();
    router.push({ name: "auth.login" });
    success("Yeay, your account has been created!");
  } else {
    errors.name = responseBody?.name?.length ? responseBody.name[0] : null;
    errors.username = responseBody?.username?.length
      ? responseBody.username[0]
      : null;
    errors.password = responseBody?.password?.length
      ? responseBody.password[0]
      : null;
  }
}

function resetErrorBag() {
  errors.name = null;
  errors.username = null;
  errors.password = null;
}

function resetInput() {
  user.username = "";
  user.name = "";
  user.password = "";
  user.password_confirmation = "";
}
</script>

<template>
  <section>
    <div class="text-center mb-8">
      <div class="inline-block p-3 bg-gradient rounded-full mb-4">
        <i class="fas fa-user-plus text-3xl text-white"></i>
      </div>
      <h1 class="text-3xl font-bold text-white">Contact Management</h1>
      <p class="text-gray-300 mt-2">Create a new account</p>
    </div>
    <form @submit.prevent="handleRegister">
      <div class="mb-4">
        <label
          for="username"
          class="block text-gray-300 text-sm font-medium mb-2"
          >Username
        </label>
        <div class="relative">
          <div
            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
          >
            <i class="fas fa-user text-gray-500"></i>
          </div>
          <input
            type="text"
            id="username"
            name="username"
            class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            placeholder="Choose a username"
            required
            v-model="user.username"
          />
        </div>
        <p v-if="errors.username" class="text-red-500 text-sm font-bold">
          {{ errors.username }}
        </p>
      </div>

      <div class="mb-4">
        <label for="name" class="block text-gray-300 text-sm font-medium mb-2"
          >Full Name</label
        >
        <div class="relative">
          <div
            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
          >
            <i class="fas fa-id-card text-gray-500"></i>
          </div>
          <input
            type="text"
            id="name"
            name="name"
            class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            placeholder="Enter your full name"
            required
            v-model="user.name"
          />
        </div>
        <p v-if="errors.name" class="text-red-500 text-sm font-bold">
          {{ errors.name }}
        </p>
      </div>

      <div class="mb-4">
        <label
          for="password"
          class="block text-gray-300 text-sm font-medium mb-2"
          >Password</label
        >
        <div class="relative">
          <div
            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
          >
            <i class="fas fa-lock text-gray-500"></i>
          </div>
          <input
            type="password"
            id="password"
            name="password"
            class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            placeholder="Create a password"
            required
            v-model="user.password"
          />
        </div>
        <p v-if="errors.password" class="text-red-500 text-sm font-bold">
          {{ errors.password }}
        </p>
      </div>

      <div class="mb-6">
        <label
          for="confirm_password"
          class="block text-gray-300 text-sm font-medium mb-2"
          >Confirm Password</label
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
            placeholder="Confirm your password"
            required
            v-model="user.password_confirmation"
          />
        </div>
      </div>

      <div class="mb-6">
        <button
          type="submit"
          class="w-full bg-gradient text-white py-3 px-4 rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5"
        >
          <i class="fas fa-user-plus mr-2"></i> Register
        </button>
      </div>

      <div class="text-center text-sm text-gray-400">
        Already have an account?
        <RouterLink
          :to="{ name: 'auth.login' }"
          class="text-blue-400 hover:text-blue-300 font-medium transition-colors duration-200"
          >Sign in
        </RouterLink>
      </div>
    </form>
  </section>
</template>

<style scoped>
</style>