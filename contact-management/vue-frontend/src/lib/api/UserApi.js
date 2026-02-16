import { useLocalStorage } from "@vueuse/core";

export const userRegister = async (user) => {
    return await fetch(`${import.meta.env.VITE_API_URL}/users`, {
        method: 'POST',
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            username: user.username,
            name: user.name,
            password: user.password,
            password_confirmation: user.password_confirmation
        })
     }
    );
}

export const userLogin = async (user) => {
    return await fetch(`${import.meta.env.VITE_API_URL}/users/login`, {
        method: 'POST',
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            username: user.username,
            password: user.password,
        })
     }
    );
}

export const userCurrent = async () => {
    return await fetch(`${import.meta.env.VITE_API_URL}/users/current`, {
        method: 'GET',
        headers: {
            "Accept": "application/json",
            "Authorization" : useLocalStorage('token', '').value
        }
     }
    );   
}

export const userUpdateName = async (user) => {
    return await fetch(`${import.meta.env.VITE_API_URL}/users/current`, {
        method: 'PATCH',
        headers: {
            "Accept": "application/json",
            "Authorization": useLocalStorage('token', '').value,
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            name: user.name
        })
     }
    );   
}

export const userUpdatePassword = async (user) => {
    return await fetch(`${import.meta.env.VITE_API_URL}/users/current`, {
        method: 'PATCH',
        headers: {
            "Accept": "application/json",
            "Authorization": useLocalStorage('token', '').value,
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            password: user.password,
            password_confirmation: user.password_confirmation
        })
     }
    );   
}

export const userLogout = async () => {
    return await fetch(`${import.meta.env.VITE_API_URL}/users/logout`, {
        method: 'DELETE',
        headers: {
            "Accept": "application/json",
            "Authorization": useLocalStorage('token', '').value,
        }
     }
    );   
}