    
    <button id="btnVolverArriba" class="boton-flotante">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        class BotonFlotante {
    constructor() {
        this.boton = document.getElementById('btnVolverArriba');
        this.umbralVisibilidad = 300; // Píxeles de scroll para mostrar el botón
        this.init();
    }

    init() {
        // Mostrar/ocultar botón al hacer scroll
        window.addEventListener('scroll', () => {
            if (window.scrollY > this.umbralVisibilidad) {
                this.boton.classList.add('visible');
            } else {
                this.boton.classList.remove('visible');
            }
        });

        // Evento click para volver arriba
        this.boton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new BotonFlotante();
});
    </script>
</body>