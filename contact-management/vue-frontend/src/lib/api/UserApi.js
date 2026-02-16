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