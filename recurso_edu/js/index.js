
document.addEventListener('DOMContentLoaded', function () {
    console.log('Página cargada - Diseño responsivo con Grid 2x2 y líneas marcadas');

    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            const width = window.innerWidth;
            console.log(`Ancho de pantalla: ${width}px`);

            if (width <= 768) {
                console.log('📱 Modo móvil: grid 1 columna | menú debajo logos | imagen abajo título');
            } else if (width <= 900) {
                console.log('📟 Modo tablet: grid 2 columnas');
            } else {
                console.log('🖥️ Modo desktop: GRID 2x2 con líneas marcadas');
            }
        }, 250);
    });

    const cards = document.querySelectorAll('.resource-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transition = 'all 0.3s ease';
        });
    });

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

    const allImages = document.querySelectorAll('img');
    allImages.forEach(img => {
        img.addEventListener('error', function () {
            console.warn(`Imagen no encontrada: ${this.src}`);
        });
    });

    const gridItems = document.querySelectorAll('.grid-2x2 .resource-card');
    console.log(`📊 Grid 2x2: ${gridItems.length} elementos (deberían ser 4 recursos)`);

    console.log('✅ ITVO - Recursos Digitales Educativos | Grid 2x2 con líneas marcadas');
    console.log('🎨 Características:');
    console.log('   • Desktop (>768px): GRID 2x2 con bordes azules visibles');
    console.log('   • Móvil (≤768px): 1 columna, menú debajo logos, imagen abajo título');
    console.log('   • Líneas del grid marcadas con bordes azules (#3b82f6)');
});