<script setup>
import { reactive } from "vue";
import { userLogin } from "@/lib/api/UserApi";
import { success } from "@/alert";
import { useRouter } from "vue-router";
import Auth from "@/components/layouts/Auth.vue";
import { useLocalStorage } from "@vueuse/core";

const user = reactive({
  username: "",
  password: "",
});

const errors = reactive({
  username: null,
});

const router = useRouter();
const token = useLocalStorage("token", "");

async function handleLogin() {
  const response = await userLogin(user);
  const responseBody = await response.json();

  if (response.status === 200) {
    token.value = responseBody.data.token;
    router.push({ name: "dashboard" });
    success("Login successfully!");
  } else {
    errors.username = responseBody.username.length
      ? responseBody.username[0]
      : null;
  }
}
</script>

<template>
  <Auth title="Sign in to your account">
    <form @submit.prevent="handleLogin">
      <div class="mb-5">
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
            placeholder="Enter your username"
            required
            v-model="user.username"
          />
          <p v-if="errors.username" class="text-red-500 text-sm font-bold">
            {{ errors.username }}
          </p>
        </div>
      </div>

      <div class="mb-6">
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
            placeholder="Enter your password"
            required
            v-model="user.password"
          />
        </div>
      </div>

      <div class="mb-6">
        <button
          type="submit"
          class="w-full bg-gradient text-white py-3 px-4 rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5"
        >
          <i class="fas fa-sign-in-alt mr-2"></i> Sign In
        </button>
      </div>

      <div class="text-center text-sm text-gray-400">
        Don't have an account?
        <RouterLink
          :to="{ name: 'register' }"
          class="text-blue-400 hover:text-blue-300 font-medium transition-colors duration-200"
          >Sign up
        </RouterLink>
      </div>
    </form>
  </Auth>
</template>

<style scoped>
</style>