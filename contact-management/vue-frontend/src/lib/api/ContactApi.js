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

export const fetchContact = async (queryParams) => {
    
    const url = new URL(`${import.meta.env.VITE_API_URL}/contacts`);
    if(queryParams.name) url.searchParams.append('name', queryParams.name);
    if(queryParams.email) url.searchParams.append('email', queryParams.email);
    if (queryParams.phone) url.searchParams.append('phone', queryParams.phone);
    if (queryParams.page) url.searchParams.append('page', queryParams.page);
    
    return await fetch(url, {
        method: 'GET',
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization" : useLocalStorage('token', '').value
        },
     }
    );
}

export const deleteContact = async (id) => {
    return await fetch(`${import.meta.env.VITE_API_URL}/contacts/${id}`, {
        method: 'DELETE',
        headers: {
            "Accept": "application/json",
            "Authorization" : useLocalStorage('token', '').value
        }
     }
    );
}

export const detailContact = async (id) => {
    return await fetch(`${import.meta.env.VITE_API_URL}/contacts/${id}`, {
        method: 'GET',
        headers: {
            "Accept": "application/json",
            "Authorization" : useLocalStorage('token', '').value
        }
     }
    );
}

export const updateContact = async (id, contact) => {
    return await fetch(`${import.meta.env.VITE_API_URL}/contacts/${id}`, {
        method: 'PATCH',
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

