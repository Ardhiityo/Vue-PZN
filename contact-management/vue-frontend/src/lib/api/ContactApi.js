import { useLocalStorage } from "@vueuse/core";

export const createContact = async (contact) => {
    return await fetch(`${import.meta.env.VITE_API_URL}/contacts`, {
        method: 'POST',
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization" : useLocalStorage('token', '').value
        },
        body: JSON.stringify({
            first_name: contact.first_name,
            last_name: contact.last_name,
            email: contact.email,
            phone: contact.phone
        })
     }
    );
}