(() => {
    "use strict";

    function iniciarInflables() {
        const pagina = document.querySelector(".ci-page");
        if (!pagina) return;

        const track = pagina.querySelector("#ci-track");
        if (!track || track.dataset.ciInitialized) return;

        track.dataset.ciInitialized = "true";

        const tarjetas = [...track.querySelectorAll(".ci-card")];
        const anterior = pagina.querySelector("#ci-previous");
        const siguiente = pagina.querySelector("#ci-next");
        const puntos = pagina.querySelector("#ci-dots");
        const botones = [
            ...pagina.querySelectorAll("[data-ci-category]")
        ];

        const movimientoReducido = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        );

        let posiciones = [0];
        let temporizador;
        let ajustePendiente;
        let scrollPendiente;
        let categoria = tarjetas.find(t => !t.hidden)
            ?.dataset.ciGroup || "publicitarios";

        function visibles() {
            return tarjetas.filter(t => !t.hidden);
        }

        function limiteScroll() {
            return Math.max(0, track.scrollWidth - track.clientWidth);
        }

        function indiceActual() {
            let indice = 0;
            let distancia = Infinity;

            posiciones.forEach((posicion, i) => {
                const diferencia = Math.abs(
                    track.scrollLeft - posicion
                );

                if (diferencia < distancia) {
                    distancia = diferencia;
                    indice = i;
                }
            });

            return indice;
        }

        function actualizarControles() {
            const indice = indiceActual();
            const sinRecorrido = posiciones.length <= 1;

            if (anterior) anterior.disabled = sinRecorrido;
            if (siguiente) siguiente.disabled = sinRecorrido;

            puntos?.querySelectorAll("button").forEach((punto, i) => {
                const activo = i === indice;

                punto.classList.toggle("is-active", activo);
                punto.setAttribute(
                    "aria-current",
                    activo ? "true" : "false"
                );
            });
        }

        function irA(indice) {
            const total = posiciones.length;
            if (!total) return;

            const destino = (indice + total) % total;

            track.scrollTo({
                left: posiciones[destino],
                behavior: movimientoReducido.matches
                    ? "auto"
                    : "smooth"
            });
        }

        function detenerAutomatico() {
            window.clearInterval(temporizador);
        }

        function iniciarAutomatico() {
            detenerAutomatico();

            if (
                document.hidden ||
                movimientoReducido.matches ||
                posiciones.length <= 1
            ) {
                return;
            }

            temporizador = window.setInterval(() => {
                // Evita mover el catálogo mientras se usa con teclado.
                if (track.contains(document.activeElement)) return;

                irA(indiceActual() + 1);
            }, 4000);
        }

        function recalcular() {
            const lista = visibles();
            const limite = limiteScroll();
            posiciones = [0];

            if (lista.length && limite > 1) {
                const rectTrack = track.getBoundingClientRect();

                lista.forEach(tarjeta => {
                    const posicion = Math.min(
                        limite,
                        Math.max(
                            0,
                            tarjeta.getBoundingClientRect().left -
                            rectTrack.left -
                            track.clientLeft +
                            track.scrollLeft
                        )
                    );

                    if (
                        Math.abs(
                            posicion - posiciones[posiciones.length - 1]
                        ) > 2
                    ) {
                        posiciones.push(posicion);
                    }
                });

                if (
                    limite - posiciones[posiciones.length - 1] > 2
                ) {
                    posiciones.push(limite);
                }
            }

            if (puntos) {
                const fragmento = document.createDocumentFragment();

                posiciones.forEach((_, indice) => {
                    const boton = document.createElement("button");

                    boton.type = "button";
                    boton.setAttribute(
                        "aria-label",
                        `Ver posición ${indice + 1} del catálogo`
                    );

                    boton.addEventListener("click", () => {
                        irA(indice);
                        iniciarAutomatico();
                    });

                    fragmento.appendChild(boton);
                });

                puntos.replaceChildren(fragmento);
                puntos.hidden = posiciones.length <= 1;
            }

            actualizarControles();
            iniciarAutomatico();
        }

        function cambiarCategoria(nuevaCategoria) {
            if (!tarjetas.some(
                tarjeta => tarjeta.dataset.ciGroup === nuevaCategoria
            )) {
                return;
            }

            categoria = nuevaCategoria;

            tarjetas.forEach(tarjeta => {
                tarjeta.hidden =
                    tarjeta.dataset.ciGroup !== categoria;
            });

            botones.forEach(boton => {
                if (!boton.closest(".ci-tabs")) return;

                const activo =
                    boton.dataset.ciCategory === categoria;

                boton.classList.toggle("is-active", activo);
                boton.setAttribute(
                    "aria-pressed",
                    activo ? "true" : "false"
                );
            });

            track.scrollTo({ left: 0, behavior: "instant" });
            recalcular();
        }

        botones.forEach(boton => {
            boton.addEventListener("click", () => {
                cambiarCategoria(boton.dataset.ciCategory);

                if (boton.hasAttribute("data-ci-jump")) {
                    pagina.querySelector("#modelos-inflables")
                        ?.scrollIntoView({
                            behavior: movimientoReducido.matches
                                ? "auto"
                                : "smooth",
                            block: "start"
                        });
                }
            });
        });

        anterior?.addEventListener("click", () => {
            irA(indiceActual() - 1);
            iniciarAutomatico();
        });

        siguiente?.addEventListener("click", () => {
            irA(indiceActual() + 1);
            iniciarAutomatico();
        });

        track.addEventListener("scroll", () => {
            window.cancelAnimationFrame(scrollPendiente);

            scrollPendiente = window.requestAnimationFrame(
                actualizarControles
            );
        }, { passive: true });

        track.addEventListener("keydown", evento => {
            if (evento.target !== track) return;

            if (evento.key === "ArrowRight") {
                evento.preventDefault();
                irA(indiceActual() + 1);
                iniciarAutomatico();
            } else if (evento.key === "ArrowLeft") {
                evento.preventDefault();
                irA(indiceActual() - 1);
                iniciarAutomatico();
            }
        });

        track.addEventListener("pointerdown", detenerAutomatico);
        window.addEventListener("pointerup", iniciarAutomatico);
        window.addEventListener("pointercancel", iniciarAutomatico);

        track.addEventListener("focusin", detenerAutomatico);
        track.addEventListener("focusout", iniciarAutomatico);

        function programarAjuste() {
            window.cancelAnimationFrame(ajustePendiente);
            ajustePendiente = window.requestAnimationFrame(recalcular);
        }

        if ("ResizeObserver" in window) {
            const observador = new ResizeObserver(programarAjuste);
            observador.observe(track);
        } else {
            window.addEventListener("resize", programarAjuste);
        }

        document.addEventListener(
            "visibilitychange",
            iniciarAutomatico
        );

        movimientoReducido.addEventListener(
            "change",
            iniciarAutomatico
        );

        cambiarCategoria(categoria);
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            iniciarInflables,
            { once: true }
        );
    } else {
        iniciarInflables();
    }
})();