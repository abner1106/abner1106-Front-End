document.addEventListener('DOMContentLoaded', () => {
    const userJson = sessionStorage.getItem('usuarioLogueado');
    if (!userJson) {
        window.location.href = 'index.html';
        return;
    }
    
    const user = JSON.parse(userJson);
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    
    // Simplistic RBAC
    if (currentPage.includes('admin') && user.role !== 'admin') {
        window.location.href = 'index.html';
    } else if (currentPage.includes('seller') && user.role !== 'seller') {
        window.location.href = 'index.html';
    } else if (currentPage.includes('client') && user.role !== 'client') {
        window.location.href = 'index.html';
    }

    const usernameDisplay = document.getElementById('displayUsername');
    if (usernameDisplay) {
        usernameDisplay.textContent = user.name;
    }
    
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', () => {
            sessionStorage.removeItem('usuarioLogueado');
            window.location.href = 'index.html';
        });
    }
});
