<script setup>
import { userLogout } from "@/lib/api/UserApi";
import { useLocalStorage } from "@vueuse/core";
import { onBeforeMount } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

onBeforeMount(async () => {
  const response = await userLogout();

  if (response.status === 200) {
    useLocalStorage("token").value = null;
    router.push({ name: "auth.login" });
  }
});
</script>