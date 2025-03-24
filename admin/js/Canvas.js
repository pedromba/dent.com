document.addEventListener('DOMContentLoaded', function() {
    // Inicializar offcanvas
    const offcanvasElement = document.getElementById('menuOffcanvas');
    const offcanvas = new bootstrap.Offcanvas(offcanvasElement);

    // Cerrar offcanvas en clic de enlace en móvil
    const menuLinks = document.querySelectorAll('.menu-mobile a');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                offcanvas.hide();
            }
        });
    });

    // Manejar redimensionamiento de ventana
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            offcanvas.hide();
        }
    });
});