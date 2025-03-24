class ContadorEstadisticas {
    constructor(elemento, objetivo, duracion = 2000) {
        this.elemento = elemento;
        this.objetivo = parseInt(objetivo);
        this.duracion = duracion;
        this.actual = 0;
        this.sufijo = elemento.dataset.sufijo || '';
        this.incremento = (this.objetivo / this.duracion) * 10;
    }

    animar() {
        if (this.actual < this.objetivo) {
            this.actual = Math.min(this.actual + this.incremento, this.objetivo);
            this.elemento.textContent = Math.floor(this.actual) + this.sufijo;
            requestAnimationFrame(this.animar.bind(this));
        }
    }

    static iniciarContadores() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const contadores = entry.target.querySelectorAll('.contador');
                    contadores.forEach(contador => {
                        const objetivo = contador.dataset.objetivo;
                        new ContadorEstadisticas(contador, objetivo).animar();
                    });
                    observer.unobserve(entry.target);
                }
            });
        };

        const observer = new IntersectionObserver(observerCallback, observerOptions);
        const seccionEstadisticas = document.querySelector('.estadisticas');
        
        if (seccionEstadisticas) {
            observer.observe(seccionEstadisticas);
        }
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    ContadorEstadisticas.iniciarContadores();
});

// Reiniciar contadores cuando la sección vuelva a ser visible
document.addEventListener('scroll', () => {
    const seccionEstadisticas = document.querySelector('.estadisticas');
    if (seccionEstadisticas) {
        const rect = seccionEstadisticas.getBoundingClientRect();
        const isVisible = (rect.top <= window.innerHeight) && (rect.bottom >= 0);
        if (isVisible) {
            const contadores = seccionEstadisticas.querySelectorAll('.contador');
            contadores.forEach(contador => {
                if (contador.textContent === '0') {
                    const objetivo = contador.dataset.objetivo;
                    new ContadorEstadisticas(contador, objetivo).animar();
                }
            });
        }
    }
});