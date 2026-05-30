document.addEventListener('DOMContentLoaded', () => {
    // Check if user is already logged in
    const userJson = sessionStorage.getItem('usuarioLogueado');
    if (userJson) {
        const user = JSON.parse(userJson);
        redirectByRole(user.role);
    }

    const form = document.getElementById('loginForm');
    const errorMsg = document.getElementById('errorMsg');

    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const userStr = document.getElementById('username').value;
            const passStr = document.getElementById('password').value;
            
            errorMsg.textContent = "";

            // Validate password policy:
            // - Starts with an uppercase
            // - At least one number, one lower case, one special character
            // - Minimum 8 characters
            const pwdRegex = /^[A-Z](?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9]).{7,}$/;
            
            if (!pwdRegex.test(passStr)) {
                errorMsg.textContent = "La contraseña debe iniciar con mayúscula, tener un número, una minúscula, un carácter especial y 8 caracteres mínimo.";
                return;
            }

            // Check users
            const users = JSON.parse(localStorage.getItem('usersTable')) || [];
            const authenticatedUser = users.find(u => u.username === userStr && u.password === passStr);

            if (authenticatedUser) {
                // Set session
                sessionStorage.setItem('usuarioLogueado', JSON.stringify(authenticatedUser));
                redirectByRole(authenticatedUser.role);
            } else {
                errorMsg.textContent = "Usuario o contraseña incorrectos.";
            }
        });
    }

    function redirectByRole(role) {
        switch(role) {
            case 'admin':
                window.location.href = 'dashboard_admin.html';
                break;
            case 'seller':
                window.location.href = 'dashboard_seller.html';
                break;
            case 'client':
                window.location.href = 'dashboard_client.html';
                break;
        }
    }
});
