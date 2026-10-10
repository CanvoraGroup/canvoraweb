(() => {
    'use strict';

    const iniciar = () => {
        const root = document.querySelector('#ci-inflables');
        if (!root || root.dataset.initialized) return;
        root.dataset.initialized = 'true';

        const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)');

        // PORTADA CON PLATAFORMA 3D
        const showcase = root.querySelector('.ci-showcase');
        const stage = root.querySelector('[data-ci-stage]');
        const scenes = [...root.querySelectorAll('[data-ci-scene]')];
        const tabs = [...root.querySelectorAll('[data-ci-slide]')];
        const caption = root.querySelector('[data-ci-caption]');
        const pauseButton = root.querySelector('[data-ci-pause]');

        if (showcase && stage && scenes.length) {
            const titles = ['Publicidad que destaca', 'Activa tu marca', 'Diversión a lo grande'];
            let current = 0;
            let timer = null;
            let paused = reducedMotion.matches;
            let hovered = false;
            let visible = true;

            const show = (index) => {
                current = (index + scenes.length) % scenes.length;
                scenes.forEach((scene, i) => {
                    const active = i === current;
                    scene.classList.toggle('is-active', active);
                    scene.setAttribute('aria-hidden', String(!active));
                    scene.inert = !active;
                });
                tabs.forEach((tab) => {
                    const active = Number(tab.dataset.ciSlide) === current;
                    tab.classList.toggle('is-active', active);
                    tab.setAttribute('aria-pressed', String(active));
                });
                if (caption) caption.textContent = titles[current] || 'Productos destacados';
            };

            const stop = () => {
                window.clearInterval(timer);
                timer = null;
            };

            const start = () => {
                stop();
                if (paused || hovered || !visible || document.hidden || showcase.contains(document.activeElement) || scenes.length < 2) return;
                timer = window.setInterval(() => show(current + 1), 2000);
            };

            const updatePause = () => {
                if (!pauseButton) return;
                pauseButton.textContent = paused ? 'Reanudar' : 'Pausar';
                pauseButton.setAttribute('aria-label', paused ? 'Reanudar cambio automático' : 'Pausar cambio automático');
                pauseButton.setAttribute('aria-pressed', String(paused));
            };

            const select = (index) => {
                show(index);
                start();
            };

            root.querySelector('[data-ci-prev]')?.addEventListener('click', () => select(current - 1));
            root.querySelector('[data-ci-next]')?.addEventListener('click', () => select(current + 1));
            tabs.forEach((tab) => tab.addEventListener('click', () => select(Number(tab.dataset.ciSlide))));

            pauseButton?.addEventListener('click', () => {
                paused = !paused;
                updatePause();
                start();
            });

            showcase.addEventListener('pointerenter', (event) => {
                if (event.pointerType !== 'mouse') return;
                hovered = true;
                stop();
            });

            showcase.addEventListener('pointerleave', (event) => {
                if (event.pointerType !== 'mouse') return;
                hovered = false;
                stage.style.removeProperty('--ci-rx');
                stage.style.removeProperty('--ci-ry');
                start();
            });

            showcase.addEventListener('focusin', stop);
            showcase.addEventListener('focusout', () => window.requestAnimationFrame(start));
            document.addEventListener('visibilitychange', start);

            stage.addEventListener('pointermove', (event) => {
                if (!finePointer.matches || reducedMotion.matches || event.pointerType !== 'mouse') return;
                const rect = stage.getBoundingClientRect();
                const x = (event.clientX - rect.left) / rect.width - 0.5;
                const y = (event.clientY - rect.top) / rect.height - 0.5;
                stage.style.setProperty('--ci-rx', `${(-y * 5).toFixed(2)}deg`);
                stage.style.setProperty('--ci-ry', `${(x * 7).toFixed(2)}deg`);
            });

            reducedMotion.addEventListener('change', (event) => {
                paused = event.matches;
                stage.style.removeProperty('--ci-rx');
                stage.style.removeProperty('--ci-ry');
                updatePause();
                start();
            });

            if ('IntersectionObserver' in window) {
                new IntersectionObserver((entries) => {
                    visible = entries[0].isIntersecting;
                    start();
                }, { threshold: 0.15 }).observe(showcase);
            }

            show(0);
            updatePause();
            start();
        }

        // CATÁLOGO 3D CON CATEGORÍAS
        const catalog = root.querySelector('[data-cic-catalog]');
        if (!catalog) return;

        const cards = [...catalog.querySelectorAll('[data-cic-card]')];
        const filters = [...root.querySelectorAll('[data-ci-filter]')];
        const catalogStage = catalog.querySelector('[data-cic-stage]');
        const previousButton = catalog.querySelector('[data-cic-prev]');
        const nextButton = catalog.querySelector('[data-cic-next]');
        const catalogPause = catalog.querySelector('[data-cic-pause]');
        const positionLabel = catalog.querySelector('[data-cic-position]');
        const totalLabel = catalog.querySelector('[data-cic-total]');
        const announcement = catalog.querySelector('[data-cic-announcement]');

        if (!cards.length || !catalogStage || !previousButton || !nextButton || !catalogPause || !positionLabel || !totalLabel) return;

        let items = [...cards];
        let index = 0;
        let timer = null;
        let paused = reducedMotion.matches;
        let hovered = false;
        let visible = true;
        let swipeStart = null;

        const stop = () => {
            window.clearInterval(timer);
            timer = null;
        };

        const render = (nextIndex, announce = false) => {
            const total = items.length;
            if (!total) return;

            index = (nextIndex + total) % total;
            const currentCard = items[index];
            const previousCard = total > 1 ? items[(index - 1 + total) % total] : null;
            const nextCard = total > 2 ? items[(index + 1) % total] : null;

            cards.forEach((card) => {
                const active = card === currentCard;
                card.classList.toggle('is-current', active);
                card.classList.toggle('is-previous', card === previousCard);
                card.classList.toggle('is-next', card === nextCard);
                card.setAttribute('aria-hidden', String(!active));
                card.inert = !active;
            });

            positionLabel.textContent = String(index + 1).padStart(2, '0');
            totalLabel.textContent = String(total).padStart(2, '0');
            previousButton.disabled = total < 2;
            nextButton.disabled = total < 2;
            catalogPause.hidden = total < 2;

            if (announce && announcement) {
                announcement.textContent = `${currentCard.querySelector('h3').textContent}, producto ${index + 1} de ${total}`;
            }
        };

        const start = () => {
            stop();
            if (paused || hovered || !visible || document.hidden || swipeStart || catalog.contains(document.activeElement) || items.length < 2) return;
            timer = window.setInterval(() => render(index + 1), 2000);
        };

        const move = (direction) => {
            render(index + direction, true);
            start();
        };

        const filter = (category) => {
            const selection = cards.filter((card) => category === 'todos' || card.dataset.category === category);
            if (!selection.length) return;

            stop();
            items = selection;
            filters.forEach((button) => {
                const active = button.dataset.ciFilter === category;
                button.classList.toggle('is-active', active);
                button.setAttribute('aria-pressed', String(active));
            });
            render(0, true);
            start();
        };

        const updatePause = () => {
            catalogPause.textContent = paused ? 'Reanudar' : 'Pausar';
            catalogPause.setAttribute('aria-pressed', String(paused));
            catalogPause.setAttribute('aria-label', paused ? 'Reanudar carrusel del catálogo' : 'Pausar carrusel del catálogo');
        };

        previousButton.addEventListener('click', () => move(-1));
        nextButton.addEventListener('click', () => move(1));
        filters.forEach((button) => button.addEventListener('click', () => filter(button.dataset.ciFilter)));

        catalogPause.addEventListener('click', () => {
            paused = !paused;
            updatePause();
            start();
        });

        catalog.addEventListener('pointerenter', (event) => {
            if (event.pointerType !== 'mouse') return;
            hovered = true;
            stop();
        });

        catalog.addEventListener('pointerleave', (event) => {
            if (event.pointerType !== 'mouse') return;
            hovered = false;
            start();
        });

        catalog.addEventListener('focusin', stop);
        catalog.addEventListener('focusout', () => window.requestAnimationFrame(start));
        document.addEventListener('visibilitychange', start);

        // NAVEGACIÓN CON TECLADO
        catalogStage.addEventListener('keydown', (event) => {
            if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
            event.preventDefault();
            move(event.key === 'ArrowRight' ? 1 : -1);
            items[index].querySelector('a')?.focus({ preventScroll: true });
        });

        // DESLIZAMIENTO EN CELULAR
        catalogStage.addEventListener('pointerdown', (event) => {
            if (event.pointerType === 'mouse' || event.target.closest('a,button')) return;
            swipeStart = { id: event.pointerId, x: event.clientX, y: event.clientY };
            catalogStage.setPointerCapture(event.pointerId);
            stop();
        });

        catalogStage.addEventListener('pointerup', (event) => {
            if (!swipeStart || swipeStart.id !== event.pointerId) return;
            const dx = event.clientX - swipeStart.x;
            const dy = event.clientY - swipeStart.y;
            swipeStart = null;
            if (Math.abs(dx) > 45 && Math.abs(dx) > Math.abs(dy)) move(dx < 0 ? 1 : -1);
            else start();
        });

        const cancelSwipe = (event) => {
            if (!swipeStart || swipeStart.id !== event.pointerId) return;
            swipeStart = null;
            start();
        };

        catalogStage.addEventListener('pointercancel', cancelSwipe);
        catalogStage.addEventListener('lostpointercapture', cancelSwipe);

        reducedMotion.addEventListener('change', (event) => {
            paused = event.matches;
            updatePause();
            start();
        });

        // ENLACES DESDE LAS SECCIONES DE EVENTOS
        root.querySelectorAll('[data-ci-event-filter]').forEach((link) => {
            link.addEventListener('click', () => filter(link.dataset.ciEventFilter));
        });

        // PAUSA CUANDO EL CATÁLOGO SALE DE LA PANTALLA
        if ('IntersectionObserver' in window) {
            new IntersectionObserver((entries) => {
                visible = entries[0].isIntersecting;
                start();
            }, { threshold: 0.15 }).observe(catalogStage);
        }

        render(0);
        updatePause();
        start();
    };

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', iniciar, { once: true });
    else iniciar();
})();