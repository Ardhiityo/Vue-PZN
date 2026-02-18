import {useLocalStorage} from "@vueuse/core";

export const createAddress = async (contactId, address) => {
  return await fetch(
    `${import.meta.env.VITE_API_URL}/contacts/${contactId}/addresses`,
    {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: useLocalStorage("token", "").value,
      },
      body: JSON.stringify({
        street: address.street,
        city: address.city,
        province: address.province,
        country: address.country,
        postal_code: address.postal_code,
      }),
    },
  );
};

export const fetchAddress = async (contactId) => {
  return await fetch(
    `${import.meta.env.VITE_API_URL}/contacts/${contactId}/addresses`,
    {
      method: "GET",
      headers: {
        Accept: "application/json",
        Authorization: useLocalStorage("token", "").value,
      },
    },
  );
};

export const detailAddress = async (contactId, addressId) => {
  return await fetch(
    `${import.meta.env.VITE_API_URL}/contacts/${contactId}/addresses/${addressId}`,
    {
      method: "GET",
      headers: {
        Accept: "application/json",
        Authorization: useLocalStorage("token", "").value,
      },
    },
  );
};

export const updateAddress = async (contactId, addressId, address) => {
  return await fetch(
    `${import.meta.env.VITE_API_URL}/contacts/${contactId}/addresses/${addressId}`,
    {
      method: "PATCH",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: useLocalStorage("token", "").value,
      },
      body: JSON.stringify({
        street: address.street,
        city: address.city,
        province: address.province,
        country: address.country,
        postal_code: address.postal_code,
      }),
    },
  );
};
