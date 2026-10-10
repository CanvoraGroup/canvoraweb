(() => {
    "use strict";
    function iniciar() {
        const hero = document.querySelector(".hero");
        if (!hero || hero.dataset.inicioInitialized) return;
        hero.dataset.inicioInitialized = "true";
        const reduced = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        );
        const mobile = window.matchMedia("(max-width: 767px)");
        const small = window.matchMedia("(max-width: 600px)");
        const fine = window.matchMedia(
            "(hover: hover) and (pointer: fine)"
        );
        /* MENÚ */
        const menuButton = document.querySelector(".menu-toggle");
        const nav = document.querySelector(".main-nav");
        function cerrarMenu() {
            if (!menuButton || !nav) return;
            nav.classList.remove("is-open");
            menuButton.setAttribute("aria-expanded", "false");
            menuButton.setAttribute("aria-label", "Abrir menú");
            menuButton.querySelector("use")
                ?.setAttribute("href", "#i-menu");
        }
        if (menuButton && nav) {
            menuButton.addEventListener("click", () => {
                const abierto =
                    menuButton.getAttribute("aria-expanded") !== "true";
                nav.classList.toggle("is-open", abierto);
                menuButton.setAttribute(
                    "aria-expanded",
                    String(abierto)
                );
                menuButton.setAttribute(
                    "aria-label",
                    abierto ? "Cerrar menú" : "Abrir menú"
                );
                menuButton.querySelector("use")?.setAttribute(
                    "href",
                    abierto ? "#i-close" : "#i-menu"
                );
            });
            nav.querySelectorAll("a").forEach(link => {
                link.addEventListener("click", cerrarMenu);
            });
            document.addEventListener("click", event => {
                if (
                    !nav.contains(event.target) &&
                    !menuButton.contains(event.target)
                ) {
                    cerrarMenu();
                }
            });
            document.addEventListener("keydown", event => {
                if (
                    event.key === "Escape" &&
                    nav.classList.contains("is-open")
                ) {
                    cerrarMenu();
                    menuButton.focus();
                }
            });
            window.matchMedia("(max-width: 850px)")
                .addEventListener("change", cerrarMenu);
        }
        /* LAPTOP */
        const area = document.getElementById("laptop-area");
        const laptop = document.getElementById("laptop");
        const display = laptop?.querySelector(".laptop-display");
        const slides = [
            ...hero.querySelectorAll(".screen-slide[data-slide]")
        ];
        if (area && laptop && display && slides.length) {
            prepararLaptop();
        }
        function prepararLaptop() {
            // Los controles comparten la transformación 3D de la pantalla.
            let controls = area.querySelector(".laptop-controls");
            if (!controls) {
                controls = document.createElement("div");
                controls.className = "laptop-controls";
            }
            display.append(controls);
            const tabs = area.querySelector(".screen-tabs");
            if (tabs) {
                controls.prepend(tabs);
            }
            let details = display.querySelector(".screen-details");
            if (!details) {
                details = document.createElement("div");
                details.className = "screen-details";
                display.append(details);
            }
            slides.forEach(slide => {
                const copy = slide.querySelector(".screen-copy");
                if (!copy) return;
                copy.classList.remove("screen-copy");
                copy.classList.add("screen-detail");
                copy.dataset.detail = slide.dataset.slide;
                details.append(copy);
            });
            let playback = controls.querySelector(".screen-playback");
            if (!playback) {
                playback = document.createElement("div");
                playback.className = "screen-playback";
                controls.append(playback);
            }
            [
                ".screen-prev",
                ".screen-pause",
                ".screen-next"
            ].forEach(selector => {
                const button = area.querySelector(selector);
                if (button) playback.append(button);
            });
            const progressTrack = area.querySelector(".screen-progress");
            if (progressTrack) {
                controls.append(progressTrack);
            }
            const buttons = [
                ...controls.querySelectorAll("[data-screen-select]")
            ];
            const detailItems = [
                ...details.querySelectorAll(
                    ".screen-detail, .cv-screen-detail"
                )
            ];
            const pause = controls.querySelector(".screen-pause");
            const progress = controls.querySelector(
                "#screen-progress-fill"
            );
            const status = document.getElementById("screen-status");
            const INTERVAL = 7000;
            let index = slides.findIndex(slide =>
                slide.classList.contains("is-active")
            );
            if (index < 0) index = 0;
            let paused = reduced.matches;
            let hovered = false;
            let focused = false;
            let visible = true;
            let timer = null;
            let animation = null;
            function detener() {
                window.clearTimeout(timer);
                timer = null;
                animation?.cancel();
                animation = null;
                if (progress) {
                    progress.style.width = "0%";
                }
            }
            function actualizarPausa() {
                if (!pause) return;
                pause.setAttribute("aria-pressed", String(paused));
                pause.setAttribute(
                    "aria-label",
                    paused
                        ? "Activar presentación automática"
                        : "Pausar presentación automática"
                );
                pause.querySelector("use")?.setAttribute(
                    "href",
                    paused ? "#i-play" : "#i-pause"
                );
            }
            function programar() {
                detener();
                if (
                    paused ||
                    hovered ||
                    focused ||
                    !visible ||
                    document.hidden ||
                    slides.length < 2
                ) {
                    return;
                }
                if (progress && !reduced.matches) {
                    animation = progress.animate(
                        [
                            { width: "0%" },
                            { width: "100%" }
                        ],
                        {
                            duration: INTERVAL,
                            easing: "linear",
                            fill: "forwards"
                        }
                    );
                }
                timer = window.setTimeout(() => {
                    mostrar(index + 1, false);
                }, INTERVAL);
            }
            function mostrar(nextIndex, manual = true) {
                index =
                    (nextIndex + slides.length) % slides.length;
                const key = slides[index].dataset.slide;
                if (manual) paused = true;
                slides.forEach(slide => {
                    const active = slide.dataset.slide === key;
                    slide.classList.toggle("is-active", active);
                    slide.setAttribute(
                        "aria-hidden",
                        String(!active)
                    );
                    slide.inert = !active;
                });
                buttons.forEach(button => {
                    const active =
                        button.dataset.screenSelect === key;
                    button.classList.toggle("is-active", active);
                    button.setAttribute(
                        "aria-pressed",
                        String(active)
                    );
                });
                detailItems.forEach(detail => {
                    const active = detail.dataset.detail === key;
                    detail.classList.toggle("is-active", active);
                    detail.setAttribute(
                        "aria-hidden",
                        String(!active)
                    );
                    detail.inert = !active;
                    detail.querySelectorAll("a").forEach(link => {
                        link.tabIndex = active ? 0 : -1;
                    });
                });
                if (manual && status) {
                    const activeDetail = detailItems.find(
                        detail => detail.dataset.detail === key
                    );
                    status.textContent =
                        activeDetail?.querySelector("h2, h3")
                            ?.textContent || key;
                }
                actualizarPausa();
                programar();
            }
            buttons.forEach(button => {
                button.addEventListener("click", () => {
                    const nextIndex = slides.findIndex(
                        slide =>
                            slide.dataset.slide ===
                            button.dataset.screenSelect
                    );
                    if (nextIndex >= 0) mostrar(nextIndex);
                });
            });
            controls.querySelector(".screen-prev")
                ?.addEventListener("click", () => {
                    mostrar(index - 1);
                });
            controls.querySelector(".screen-next")
                ?.addEventListener("click", () => {
                    mostrar(index + 1);
                });
            pause?.addEventListener("click", () => {
                paused = !paused;
                actualizarPausa();
                programar();
            });
            area.addEventListener("pointerenter", event => {
                if (event.pointerType === "touch") return;
                hovered = true;
                programar();
            });
            area.addEventListener("pointerleave", () => {
                hovered = false;
                programar();
            });
            area.addEventListener("focusin", () => {
                focused = true;
                programar();
            });
            area.addEventListener("focusout", () => {
                window.setTimeout(() => {
                    focused = area.contains(document.activeElement);
                    programar();
                }, 0);
            });
            area.addEventListener("keydown", event => {
                if (
                    event.key !== "ArrowLeft" &&
                    event.key !== "ArrowRight"
                ) {
                    return;
                }
                event.preventDefault();
                mostrar(
                    index + (event.key === "ArrowRight" ? 1 : -1)
                );
            });
            document.addEventListener(
                "visibilitychange",
                programar
            );
            if ("IntersectionObserver" in window) {
                const observer = new IntersectionObserver(
                    entries => {
                        visible = entries[0].isIntersecting;
                        programar();
                    },
                    { threshold: .1 }
                );
                observer.observe(area);
            }
            reduced.addEventListener("change", () => {
                if (reduced.matches) paused = true;
                actualizarPausa();
                programar();
            });
            /*
             * Coordenadas del marco PNG de 1536 × 1024
             * que compartiste.
             */
            function ajustarMarco() {
                if (mobile.matches) {
                    display.style.removeProperty("transform");
                    laptop.dataset.photoReady = "true";
                    return;
                }
                const scale = laptop.clientWidth / 1536;
                if (!scale) return;
                const matrix = [
                    .6886168243 * scale,
                    -.07602858547 * scale,
                    0,
                    -.0001518038936,
                    -.1355582705 * scale,
                    .7975225851 * scale,
                    0,
                    -.00006434228523,
                    0,
                    0,
                    1,
                    0,
                    526 * scale,
                    160 * scale,
                    0,
                    1
                ];
                display.style.transform =
                    `matrix3d(${matrix.join(",")})`;
                laptop.dataset.photoReady = "true";
            }
            ajustarMarco();
            if ("ResizeObserver" in window) {
                new ResizeObserver(ajustarMarco).observe(laptop);
            } else {
                window.addEventListener("resize", ajustarMarco);
            }
            mobile.addEventListener("change", ajustarMarco);
            laptop.querySelector(".laptop-photo-frame")
                ?.addEventListener("load", ajustarMarco);
            mostrar(index, false);
        }
        /* CARRUSEL DE SOLUCIONES */
        const flow = document.querySelector(".coverflow");
        const stage = document.getElementById("coverflow-stage");
        const cards = [
            ...document.querySelectorAll(".solution-card[data-card]")
        ];
        if (!flow || !stage || !cards.length) return;
        const solutionButtons = [
            ...document.querySelectorAll("[data-solution-select]")
        ];
        const dots = [
            ...document.querySelectorAll("[data-solution-dot]")
        ];
        const solutionStatus =
            document.getElementById("solutions-status");
        let solutionIndex = cards.findIndex(card =>
            card.classList.contains("is-center")
        );
        if (solutionIndex < 0) solutionIndex = 0;
        let lastInteraction = 0;
        let heightFrame = null;
        let touchStart = null;
        let suppressClick = false;
        const wrap = number =>
            (number + cards.length) % cards.length;
        function ajustarAltura() {
            window.cancelAnimationFrame(heightFrame);
            heightFrame = window.requestAnimationFrame(() => {
                const height =
                    Math.ceil(cards[solutionIndex].offsetHeight + 28);
                if (stage.style.height !== `${height}px`) {
                    stage.style.height = `${height}px`;
                }
            });
        }
        function mostrarSolucion(nextIndex, manual = true) {
            solutionIndex = wrap(nextIndex);
            const key = cards[solutionIndex].dataset.card;
            if (manual) {
                lastInteraction = Date.now();
            }
            cards.forEach((card, index) => {
                const position = wrap(index - solutionIndex);
                let state = "is-hidden";
                if (position === 0) {
                    state = "is-center";
                } else if (position === 1) {
                    state = "is-right";
                } else if (position === cards.length - 1) {
                    state = "is-left";
                }
                const shown = small.matches
                    ? position === 0
                    : state !== "is-hidden";
                card.classList.remove(
                    "is-center",
                    "is-left",
                    "is-right",
                    "is-hidden"
                );
                card.classList.add(state);
                card.setAttribute("aria-hidden", String(!shown));
                card.inert = !shown;
                card.querySelectorAll("a").forEach(link => {
                    link.tabIndex = shown ? 0 : -1;
                });
            });
            solutionButtons.forEach(button => {
                const active =
                    button.dataset.solutionSelect === key;
                button.classList.toggle("is-active", active);
                button.setAttribute("aria-pressed", String(active));
            });
            dots.forEach(button => {
                const active =
                    button.dataset.solutionDot === key;
                button.classList.toggle("is-active", active);
                button.setAttribute("aria-pressed", String(active));
            });
            if (manual && solutionStatus) {
                solutionStatus.textContent =
                    cards[solutionIndex].querySelector("h3")
                        ?.textContent || key;
            }
            ajustarAltura();
        }
        function seleccionarPorClave(key) {
            const index = cards.findIndex(
                card => card.dataset.card === key
            );
            if (index >= 0) mostrarSolucion(index);
        }
        solutionButtons.forEach(button => {
            button.addEventListener("click", () => {
                seleccionarPorClave(button.dataset.solutionSelect);
            });
        });
        dots.forEach(button => {
            button.addEventListener("click", () => {
                seleccionarPorClave(button.dataset.solutionDot);
            });
        });
        flow.querySelector(".coverflow-prev")
            ?.addEventListener("click", () => {
                mostrarSolucion(solutionIndex - 1);
            });
        flow.querySelector(".coverflow-next")
            ?.addEventListener("click", () => {
                mostrarSolucion(solutionIndex + 1);
            });
        flow.addEventListener("keydown", event => {
            if (
                event.key !== "ArrowLeft" &&
                event.key !== "ArrowRight"
            ) {
                return;
            }
            event.preventDefault();
            const desdeTarjeta =
                event.target.closest(".solution-card");
            if (desdeTarjeta) flow.focus();
            mostrarSolucion(
                solutionIndex +
                (event.key === "ArrowRight" ? 1 : -1)
            );
        });
        /* DESLIZAMIENTO EN CELULAR */
        stage.addEventListener("touchstart", event => {
            lastInteraction = Date.now();
            if (event.touches.length !== 1) {
                touchStart = null;
                return;
            }
            touchStart = {
                x: event.touches[0].clientX,
                y: event.touches[0].clientY
            };
        }, { passive: true });
        stage.addEventListener("touchend", event => {
            if (!touchStart || !event.changedTouches.length) return;
            const touch = event.changedTouches[0];
            const dx = touch.clientX - touchStart.x;
            const dy = touch.clientY - touchStart.y;
            touchStart = null;
            if (
                Math.abs(dx) > 45 &&
                Math.abs(dx) > Math.abs(dy) * 1.5
            ) {
                suppressClick = true;
                mostrarSolucion(
                    solutionIndex + (dx < 0 ? 1 : -1)
                );
                window.setTimeout(() => {
                    suppressClick = false;
                }, 350);
            }
        }, { passive: true });
        stage.addEventListener("touchcancel", () => {
            touchStart = null;
        }, { passive: true });
        stage.addEventListener("click", event => {
            if (!suppressClick) return;
            event.preventDefault();
            event.stopPropagation();
        }, true);
        small.addEventListener("change", () => {
            mostrarSolucion(solutionIndex, false);
        });
        window.addEventListener("resize", ajustarAltura);
        if ("ResizeObserver" in window) {
            const observer = new ResizeObserver(ajustarAltura);
            cards.forEach(card => observer.observe(card));
        }
        cards.forEach(card => {
            card.querySelector("img")
                ?.addEventListener("load", ajustarAltura);
        });
        document.fonts?.ready.then(ajustarAltura);
        mostrarSolucion(solutionIndex, false);
        /* AVANCE AUTOMÁTICO: CADA 3 SEGUNDOS */
        window.setInterval(() => {
            const rect = flow.getBoundingClientRect();
            const visible =
                rect.bottom > 0 &&
                rect.top < window.innerHeight;
            const hovered =
                fine.matches && flow.matches(":hover");
            const focused =
                flow.contains(document.activeElement) ||
                solutionButtons.some(
                    button => button === document.activeElement
                ) ||
                dots.some(
                    button => button === document.activeElement
                );
            if (
                document.hidden ||
                reduced.matches ||
                !visible ||
                hovered ||
                focused ||
                touchStart ||
                Date.now() - lastInteraction < 6000
            ) {
                return;
            }
            mostrarSolucion(solutionIndex + 1, false);
        }, 3000);
    }
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", iniciar);
    } else {
        iniciar();
    }
})();
