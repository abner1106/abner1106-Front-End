// data.js
const defaultUsers = [
    { id: 1, username: 'admin', password: 'Password1!', role: 'admin', name: 'Admin Principal' },
    { id: 2, username: 'vendedor1', password: 'Seller1@', role: 'seller', name: 'Abner Cruz' },
    { id: 3, username: 'cliente1', password: 'Client1#', role: 'client', name: 'Honorio Juarez' }
];

// Sobrescribimos siempre el localStorage para que los cambios que hagas aquí
// se reflejen inmediatamente al recargar la página:
localStorage.setItem('usersTable', JSON.stringify(defaultUsers));
