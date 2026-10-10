(() => {
    'use strict';
    function iniciarTech() {
        const root = document.getElementById('ct-tech');
        if (!root || root.dataset.techInitialized) return;
        root.dataset.techInitialized = 'true';
        const reducirMovimiento = window.matchMedia('(prefers-reduced-motion: reduce)');
        const usarMouse = window.matchMedia('(hover: hover) and (pointer: fine)');
        const movil = window.matchMedia('(max-width: 767px)');

        // EFECTO 3D
        root.querySelectorAll('[data-ct2-tilt]').forEach(elemento => {
            let frame = 0, x = 0, y = 0;
            const intensidad = elemento.classList.contains('ct2-system-card') ? 7 : 5;
            function pintar() {
                frame = 0;
                elemento.style.setProperty('--ct2-rx', `${(-y * intensidad).toFixed(2)}deg`);
                elemento.style.setProperty('--ct2-ry', `${(x * intensidad).toFixed(2)}deg`);
            }
            function restablecer() {
                cancelAnimationFrame(frame);
                frame = 0;
                elemento.style.setProperty('--ct2-rx', '0deg');
                elemento.style.setProperty('--ct2-ry', '0deg');
            }
            elemento.addEventListener('pointermove', evento => {
                if (reducirMovimiento.matches || !usarMouse.matches || evento.pointerType !== 'mouse') return;
                const rect = elemento.getBoundingClientRect();
                if (!rect.width || !rect.height) return;
                x = Math.max(-1, Math.min(1, ((evento.clientX - rect.left) / rect.width - 0.5) * 2));
                y = Math.max(-1, Math.min(1, ((evento.clientY - rect.top) / rect.height - 0.5) * 2));
                if (!frame) frame = requestAnimationFrame(pintar);
            });
            elemento.addEventListener('pointerleave', restablecer);
            elemento.addEventListener('pointercancel', restablecer);
            reducirMovimiento.addEventListener('change', restablecer);
            usarMouse.addEventListener('change', restablecer);
            window.addEventListener('blur', restablecer);
        });

        // CARRUSEL AUTOMÁTICO
        root.querySelectorAll('[data-ct2-carousel]').forEach(carrusel => {
            const tarjetas = [...carrusel.querySelectorAll('[data-ct2-slide]')];
            const puntos = [...carrusel.querySelectorAll('[data-ct2-select]')];
            const anterior = carrusel.querySelector('[data-ct2-prev]');
            const siguiente = carrusel.querySelector('[data-ct2-next]');
            const estado = carrusel.querySelector('[data-ct2-status]');
            const escenario = carrusel.querySelector('[data-ct2-stage]');
            const total = tarjetas.length;
            if (!total) return;
            let actual = Math.max(0, tarjetas.findIndex(tarjeta => tarjeta.classList.contains('is-center')));
            let temporizador = null, inicioToque = null, evitarClick = false;
            let mouseEncima = false, interactuando = false;
            const circular = indice => ((indice % total) + total) % total;

            function mostrar(indice, anunciar = true) {
                actual = circular(indice);
                const izquierda = circular(actual - 1), derecha = circular(actual + 1);
                tarjetas.forEach((tarjeta, posicion) => {
                    let clase = 'is-hidden';
                    if (posicion === actual) clase = 'is-center';
                    else if (posicion === izquierda) clase = 'is-left';
                    else if (posicion === derecha) clase = 'is-right';
                    const visible = clase === 'is-center' || (!movil.matches && clase !== 'is-hidden');
                    if (!visible && tarjeta.contains(document.activeElement)) carrusel.focus();
                    tarjeta.classList.remove('is-center', 'is-left', 'is-right', 'is-hidden');
                    tarjeta.classList.add(clase);
                    tarjeta.setAttribute('aria-hidden', String(!visible));
                    tarjeta.toggleAttribute('inert', !visible);
                });
                const clave = tarjetas[actual].dataset.ct2Slide;
                puntos.forEach(punto => {
                    const activo = punto.dataset.ct2Select === clave;
                    punto.classList.toggle('is-active', activo);
                    punto.setAttribute('aria-pressed', String(activo));
                });
                if (estado && anunciar) {
                    const titulo = tarjetas[actual].querySelector('h3')?.textContent.trim() || '';
                    estado.textContent = `${actual + 1} de ${total}: ${titulo}`;
                }
            }

            function detenerAutomatico() {
                clearInterval(temporizador);
                temporizador = null;
            }
            function iniciarAutomatico() {
                detenerAutomatico();
                if (total < 2 || document.hidden || reducirMovimiento.matches) return;
                if (mouseEncima || interactuando || carrusel.contains(document.activeElement)) return;
                temporizador = setInterval(() => mostrar(actual + 1, false), 2000);
            }
            function navegar(indice) {
                mostrar(indice);
                iniciarAutomatico();
            }

            if (anterior) {
                anterior.disabled = total < 2;
                anterior.addEventListener('click', () => navegar(actual - 1));
            }
            if (siguiente) {
                siguiente.disabled = total < 2;
                siguiente.addEventListener('click', () => navegar(actual + 1));
            }
            puntos.forEach(punto => {
                punto.addEventListener('click', () => {
                    const indice = tarjetas.findIndex(tarjeta => tarjeta.dataset.ct2Slide === punto.dataset.ct2Select);
                    if (indice >= 0) navegar(indice);
                });
            });
            carrusel.addEventListener('keydown', evento => {
                if (evento.target.closest('input, textarea, select, [contenteditable="true"]')) return;
                if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(evento.key)) return;
                evento.preventDefault();
                if (evento.key === 'ArrowLeft') navegar(actual - 1);
                if (evento.key === 'ArrowRight') navegar(actual + 1);
                if (evento.key === 'Home') navegar(0);
                if (evento.key === 'End') navegar(total - 1);
            });

            // PAUSA AL LEER O INTERACTUAR
            carrusel.addEventListener('pointerenter', evento => {
                if (evento.pointerType !== 'mouse') return;
                mouseEncima = true;
                detenerAutomatico();
            });
            carrusel.addEventListener('pointerleave', evento => {
                if (evento.pointerType !== 'mouse') return;
                mouseEncima = false;
                iniciarAutomatico();
            });
            carrusel.addEventListener('focusin', detenerAutomatico);
            carrusel.addEventListener('focusout', () => setTimeout(iniciarAutomatico, 0));
            carrusel.addEventListener('pointerdown', () => {
                interactuando = true;
                detenerAutomatico();
            });
            function terminarInteraccion() {
                interactuando = false;
                inicioToque = null;
                iniciarAutomatico();
            }
            window.addEventListener('pointerup', terminarInteraccion);
            window.addEventListener('pointercancel', terminarInteraccion);

            // DESLIZAMIENTO EN CELULAR
            if (escenario) {
                escenario.style.touchAction = 'pan-y';
                escenario.addEventListener('pointerdown', evento => {
                    if (evento.pointerType !== 'touch' || !evento.isPrimary) return;
                    evitarClick = false;
                    inicioToque = { id: evento.pointerId, x: evento.clientX, y: evento.clientY };
                });
                escenario.addEventListener('pointerup', evento => {
                    if (!inicioToque || inicioToque.id !== evento.pointerId) return;
                    const dx = evento.clientX - inicioToque.x, dy = evento.clientY - inicioToque.y;
                    inicioToque = null;
                    if (Math.abs(dx) < 45 || Math.abs(dx) <= Math.abs(dy)) return;
                    evitarClick = true;
                    mostrar(actual + (dx < 0 ? 1 : -1));
                    setTimeout(() => { evitarClick = false; }, 400);
                });
                escenario.addEventListener('click', evento => {
                    if (!evitarClick) return;
                    evento.preventDefault();
                    evento.stopImmediatePropagation();
                    evitarClick = false;
                }, true);
            }

            document.addEventListener('visibilitychange', iniciarAutomatico);
            reducirMovimiento.addEventListener('change', iniciarAutomatico);
            window.addEventListener('blur', detenerAutomatico);
            window.addEventListener('focus', () => {
                mouseEncima = usarMouse.matches && carrusel.matches(':hover');
                iniciarAutomatico();
            });
            movil.addEventListener('change', () => mostrar(actual, false));
            mouseEncima = usarMouse.matches && carrusel.matches(':hover');
            mostrar(actual, false);
            iniciarAutomatico();
        });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', iniciarTech, { once: true });
    } else {
        iniciarTech();
    }
})();