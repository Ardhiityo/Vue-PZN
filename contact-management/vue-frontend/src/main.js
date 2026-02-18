import {createApp} from "vue";
import App from "./App.vue";
import "./assets/main.css";
import {createRouter, createWebHistory} from "vue-router";
import {userCurrent} from "./lib/api/UserApi";
import {useLocalStorage} from "@vueuse/core";

const router = createRouter({
  routes: [
    {
      path: "/auth",
      component: () => import("./components/layouts/Auth.vue"),
      children: [
        {
          path: "login",
          name: "auth.login",
          component: () => import("./components/pages/auth/Login.vue"),
        },
        {
          path: "register",
          name: "auth.register",
          component: () => import("./components/pages/auth/Register.vue"),
        },
        {
          path: "logout",
          name: "auth.logout",
          component: () => import("./components/pages/auth/Logout.vue"),
          meta: {requiresAuth: true},
        },
      ],
    },
    {
      path: "/dashboard",
      component: () => import("./components/layouts/Dashboard.vue"),
      children: [
        {
          path: "",
          name: "dashboard",
          meta: {requiresAuth: true},
          component: () => import("./components/pages/Dashboard.vue"),
        },
        {
          path: "users/profile",
          name: "dashboard.profile",
          meta: {requiresAuth: true},
          component: () => import("./components/pages/UserProfile.vue"),
        },
        {
          path: "contacts/create",
          name: "dashboard.contact.create",
          meta: {requiresAuth: true},
          component: () =>
            import("./components/pages/contacts/ContactCreate.vue"),
        },
        {
          path: "contacts/:id",
          name: "dashboard.contact.detail",
          meta: {requiresAuth: true},
          component: () =>
            import("./components/pages/contacts/ContactDetail.vue"),
        },
        {
          path: "contacts/:id/edit",
          name: "dashboard.contact.edit",
          meta: {requiresAuth: true},
          component: () =>
            import("./components/pages/contacts/ContactEdit.vue"),
        },
        {
          path: "contacts/:id/addresses/create",
          name: "dashboard.address.create",
          meta: {requiresAuth: true},
          component: () =>
            import("./components/pages/addresses/AddressCreate.vue"),
        },
        {
          path: "contacts/:id/addresses/:addressId/edit",
          name: "dashboard.address.edit",
          meta: {requiresAuth: true},
          component: () =>
            import("./components/pages/addresses/AddressEdit.vue"),
        },
      ],
    },
  ],
  history: createWebHistory(),
});

// Cara 1 : cek middleware autentikasi
// router.beforeEach(async (to, from, next) => {
//   if (to.name === "auth.login" || to.name === "auth.register") {
//     next();
//   } else {
//     const response = await userCurrent();
//     if (response.status === 200) {
//       next();
//     } else {
//       next({name: "auth.login"});
//     }
//   }
// });

// Cara 2 : cek middleware autentikasi (tambahkan meta: {requiresAuth: true} disetiap komponen)
router.beforeEach(async (to, from, next) => {
  const token = useLocalStorage("token").value;
  if (to.meta.requiresAuth) {
    if (token) {
      const response = await userCurrent();
      if (response.status === 200) {
        return next(); // lanjut ke halaman tujuan
      }
    }
    // kalau tidak ada token atau gagal validasi
    return next({name: "auth.login"});
  }

  // route publik (tidak butuh login)
  next();
});

createApp(App).use(router).mount("#app");
