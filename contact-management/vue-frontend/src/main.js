import {createApp} from "vue";
import App from "./App.vue";
import "./assets/main.css";
import {createRouter, createWebHistory} from "vue-router";

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
          component: () => import("./components/pages/Dashboard.vue"),
        },
        {
          path: "users/profile",
          name: "dashboard.profile",
          component: () => import("./components/pages/UserProfile.vue"),
        },
        {
          path: "contacts/create",
          name: "dashboard.contact.create",
          component: () =>
            import("./components/pages/contacts/ContactCreate.vue"),
        },
        {
          path: "contacts/:id",
          name: "dashboard.contact.detail",
          component: () =>
            import("./components/pages/contacts/ContactDetail.vue"),
        },
        {
          path: "contacts/:id/edit",
          name: "dashboard.contact.edit",
          component: () =>
            import("./components/pages/contacts/ContactEdit.vue"),
        },
        {
          path: "contacts/:id/addresses/create",
          name: "dashboard.address.create",
          component: () =>
            import("./components/pages/addresses/AddressCreate.vue"),
        },
        {
          path: "contacts/:id/addresses/:addressId/edit",
          name: "dashboard.address.edit",
          component: () =>
            import("./components/pages/addresses/AddressEdit.vue"),
        },
      ],
    },
  ],
  history: createWebHistory(),
});

createApp(App).use(router).mount("#app");
