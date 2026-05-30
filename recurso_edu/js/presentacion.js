// Script para manejar interactividad de la página Quiénes Somos

document.addEventListener('DOMContentLoaded', function () {
    console.log('Página cargada - Quiénes Somos | Estudiantes de Ingeniería Informática');

    // Detectar cambios de tamaño para debug
    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            const width = window.innerWidth;
            console.log(`Ancho de pantalla: ${width}px`);

            if (width <= 768) {
                console.log('📱 Modo móvil: grids en 1 columna');
            } else if (width <= 1024) {
                console.log('📟 Modo tablet: grids 2x2');
            } else {
                console.log('🖥️ Modo desktop: grids 2x2 con líneas marcadas');
            }
        }, 250);
    });

    // Animación de entrada para las tarjetas
    const cards = document.querySelectorAll('.team-card, .mv-card, .wwd-card, .project-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(card);
    });

    // Efecto hover para tarjetas
    cards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transition = 'all 0.3s ease';
        });
    });

    // Animación suave al hacer scroll para enlaces internos
    const navLinks = document.querySelectorAll('.main-nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Verificar imágenes
    const allImages = document.querySelectorAll('img');
    allImages.forEach(img => {
        img.addEventListener('error', function () {
            console.warn(`Imagen no encontrada: ${this.src}`);
        });
    });

    // Contar elementos del equipo
    const teamMembers = document.querySelectorAll('.team-card');
    console.log(`👥 Equipo: ${teamMembers.length} miembros`);

    // Mostrar mensaje de bienvenida
    console.log('✅ ITVO - Quiénes Somos');
    console.log('🎓 Estudiantes de Ingeniería Informática - Próximos a egresar');
    console.log('🎨 Características:');
    console.log('   • Grid 2x2 con líneas azules marcadas');
    console.log('   • Diseño responsivo con media queries');
    console.log('   • Animaciones de entrada para tarjetas');
    console.log('   • Logos con efectos interactivos');
});