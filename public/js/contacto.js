(() => {
    'use strict';

    function iniciar3D() {
        const card = document.getElementById('contacto-card');
        const stage = card?.closest('.cv-contact-stage');

        if (!card || !stage) {
            console.warn('Contacto 3D: no se encontró la tarjeta o su contenedor.');
            return;
        }

        if (stage.dataset.contacto3d === 'activo') return;
        stage.dataset.contacto3d = 'activo';

        const reducirMovimiento = window.matchMedia(
            '(prefers-reduced-motion: reduce)'
        );

        function resetear() {
            card.style.transform =
                'perspective(1000px) rotateX(0deg) rotateY(0deg)';
        }

        stage.addEventListener('pointermove', (event) => {
            if (
                event.pointerType === 'touch' ||
                reducirMovimiento.matches
            ) {
                return;
            }

            const rect = stage.getBoundingClientRect();

            // El contenedor permanece quieto mientras la tarjeta gira.
            const x = Math.max(0, Math.min(
                1, (event.clientX - rect.left) / rect.width
            ));

            const y = Math.max(0, Math.min(
                1, (event.clientY - rect.top) / rect.height
            ));

            const giroX = (0.5 - y) * 20;
            const giroY = (x - 0.5) * 20;

            card.style.transform =
                `perspective(1000px) rotateX(${giroX}deg) rotateY(${giroY}deg)`;
        });

        stage.addEventListener('pointerleave', resetear);
        stage.addEventListener('pointercancel', resetear);
        window.addEventListener('blur', resetear);
        reducirMovimiento.addEventListener('change', resetear);

        console.info('Contacto 3D: listo.');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', iniciar3D);
    } else {
        iniciar3D();
    }
})();