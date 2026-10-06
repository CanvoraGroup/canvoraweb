
@extends('layouts.web')

@section('title', 'Canvora Tech | Software, automatización y soporte')

@section('description', 'Desarrollamos software a medida, aplicaciones, páginas web y automatizaciones. Soluciones de datos, infraestructura y soporte para tu negocio.')

@section('contenido')

@php
    /*
     * El número se obtiene de config/canvora.php.
     * Conserva el WhatsApp que ya configuraste.
     */
    $numeroWhatsapp = preg_replace(
        '/\D/',
        '',
        (string) config('canvora.whatsapp', '')
    );

    $crearEnlaceWhatsapp = function ($mensaje) use ($numeroWhatsapp) {
        return $numeroWhatsapp !== ''
            ? 'https://wa.me/' . $numeroWhatsapp . '?text=' . rawurlencode($mensaje)
            : '#contacto';
    };

    $enlaceCotizar = $crearEnlaceWhatsapp(
        'Hola, me interesa cotizar un proyecto con Canvora Tech.'
    );

    $serviciosTech = [
        [
            'titulo' => 'Crear',
            'descripcion' => 'Software a medida, aplicaciones móviles, páginas web, ecommerce e invitaciones digitales.',
            'imagen' => 'crear.png',
            'alt' => 'Laptop con herramientas de desarrollo de software',
            'icono' => 'M8 5 2 12l6 7M16 5l6 7-6 7M14 3l-4 18',
        ],
        [
            'titulo' => 'Automatizar',
            'descripcion' => 'Flujos con n8n, integración de API, conexión entre sistemas y notificaciones automáticas.',
            'imagen' => 'automatizar.png',
            'alt' => 'Integración de aplicaciones mediante flujos de automatización',
            'icono' => 'M12 8V5M12 16v3M8 12H5M16 12h3M8 8 6 6M16 8l2-2M8 16l-2 2M16 16l2 2M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0',
        ],
        [
            'titulo' => 'Analizar',
            'descripcion' => 'Bases de datos, dashboards, reportes, análisis de información, inteligencia artificial y chatbots.',
            'imagen' => 'analizar.png',
            'alt' => 'Dashboard de información y asistente de inteligencia artificial',
            'icono' => 'M4 20V12h4v8M10 20V8h4v12M16 20V4h4v16M2 20h20',
        ],
        [
            'titulo' => 'Implementar y proteger',
            'descripcion' => 'Redes, servidores, nube, hosting, respaldos, ciberseguridad, videovigilancia y control de acceso.',
            'imagen' => 'proteger.png',
            'alt' => 'Cámara de seguridad y servidores con cableado de red',
            'icono' => 'M12 3 3 7v5c0 5 9 9 9 9s9-4 9-9V7l-9-4M8 12l3 3 5-6',
        ],
        [
            'titulo' => 'Mantener',
            'descripcion' => 'Soporte remoto y presencial, reparación, mantenimiento de equipos, consultoría y gestión TI.',
            'imagen' => 'mantener.png',
            'alt' => 'Técnico realizando mantenimiento de una laptop',
            'icono' => 'M14 6a5 5 0 0 0-6 6L3 17a3 3 0 0 0 4 4l5-5a5 5 0 0 0 6-6l-4 4-4-4 4-4',
        ],
    ];

    $sistemasTech = [
        [
            'titulo' => 'Facturación y ventas',
            'descripcion' => 'Gestiona ventas, clientes, comprobantes, cotizaciones y cuentas por cobrar.',
            'imagen' => 'facturacion.png',
            'alt' => 'Sistema de ventas en un punto de atención comercial',
            'mensaje' => 'Hola, me interesa un sistema de facturación y ventas para mi negocio.',
        ],
        [
            'titulo' => 'Inventarios y almacenes',
            'descripcion' => 'Controla productos, existencias, ingresos, salidas, kardex y alertas de stock.',
            'imagen' => 'inventarios.png',
            'alt' => 'Tablet con sistema de inventario en un almacén',
            'mensaje' => 'Hola, me interesa un sistema de inventarios y almacenes.',
        ],
        [
            'titulo' => 'Pesaje y balanzas',
            'descripcion' => 'Integra balanzas, registra pesajes y administra entradas, salidas, tickets y reportes.',
            'imagen' => 'pesaje.png',
            'alt' => 'Balanza conectada a una pantalla de gestión de pesajes',
            'mensaje' => 'Hola, me interesa un sistema de pesaje e integración con balanzas.',
        ],
        [
            'titulo' => 'Gestión odontológica',
            'descripcion' => 'Organiza pacientes, citas, historias clínicas, odontogramas, tratamientos y pagos.',
            'imagen' => 'odontologia.png',
            'alt' => 'Consultorio odontológico equipado',
            'mensaje' => 'Hola, me interesa un sistema de gestión odontológica.',
        ],
        [
            'titulo' => 'Gestión vehicular',
            'descripcion' => 'Administra vehículos, propietarios, conductores, documentos, vencimientos y pagos.',
            'imagen' => 'vehicular.png',
            'alt' => 'Tablet con sistema de gestión vehicular',
            'mensaje' => 'Hola, me interesa un sistema de gestión vehicular.',
        ],
    ];

    $pasosTech = [
        [
            'titulo' => 'Consulta',
            'descripcion' => 'Conocemos tu idea, cómo trabajas y qué necesitas resolver.',
        ],
        [
            'titulo' => 'Propuesta',
            'descripcion' => 'Definimos el alcance, los tiempos y una propuesta para tu proyecto.',
        ],
        [
            'titulo' => 'Desarrollo',
            'descripcion' => 'Diseñamos, implementamos y probamos contigo la solución.',
        ],
        [
            'titulo' => 'Entrega',
            'descripcion' => 'Ponemos en marcha el sistema y te orientamos en su uso.',
        ],
    ];

    $preguntasTech = [
        [
            'pregunta' => '¿Cuánto tiempo toma desarrollar un sistema?',
            'respuesta' => 'Depende de los módulos, las integraciones y el alcance. Después de conocer tu necesidad, te presentamos una propuesta con las etapas y los tiempos estimados.',
        ],
        [
            'pregunta' => '¿Pueden integrar un sistema con mis herramientas actuales?',
            'respuesta' => 'Sí, evaluamos las posibilidades de integración con tus sistemas, bases de datos, API y equipos. La solución depende de los accesos y las capacidades técnicas disponibles.',
        ],
        [
            'pregunta' => '¿Brindan soporte después de la entrega?',
            'respuesta' => 'Podemos incluir soporte y mantenimiento. El alcance, la duración y las condiciones se definen en la propuesta de tu proyecto.',
        ],
    ];
@endphp

<div class="ct-page">

    {{-- PORTADA --}}

    <section class="ct-hero" aria-labelledby="ct-hero-title">
        <div class="ct-shell">
            <div class="ct-hero__content">

                <p class="ct-eyebrow">Canvora Tech</p>

                <h1 id="ct-hero-title">
                    Tecnología que
                    <span>impulsa tu negocio.</span>
                </h1>

                <p class="ct-hero__description">
                    Software a medida, automatización,
                    infraestructura y soporte.
                </p>

                <div class="ct-actions">
                    <a
                        href="{{ $enlaceCotizar }}"
                        class="ct-button"
                        @if($numeroWhatsapp !== '')
                            target="_blank"
                            rel="noopener noreferrer"
                        @endif
                    >
                        Cotizar mi proyecto
                        <span aria-hidden="true">→</span>
                    </a>

                    <a href="#servicios-tech" class="ct-button ct-button--outline">
                        Explorar soluciones
                        <span aria-hidden="true">↓</span>
                    </a>
                </div>

            </div>
        </div>

        <img
            src="{{ asset('images/tech/portada.png') }}"
            alt="Especialista trabajando en soluciones tecnológicas"
            class="ct-hero__image"
            width="1672"
            height="941"
            fetchpriority="high"
        >
    </section>

    {{-- SERVICIOS --}}

    <section
        id="servicios-tech"
        class="ct-section ct-services"
        aria-labelledby="ct-services-title"
    >
        <div class="ct-shell">

            <p class="ct-eyebrow">Servicios tecnológicos</p>

            <h2 id="ct-services-title" class="ct-title">
                Soluciones completas para tu negocio
            </h2>

            <p class="ct-description">
                Integramos tecnología, procesos y soporte para ayudarte
                a trabajar mejor y hacer crecer tu empresa.
            </p>

            <div class="ct-service-grid">
                @foreach($serviciosTech as $servicio)
                    <article class="ct-service-card">

                        <div class="ct-service-card__icon">
                            <svg
                                class="ct-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="{{ $servicio['icono'] }}"></path>
                            </svg>
                        </div>

                        <h3>{{ $servicio['titulo'] }}</h3>

                        <p>{{ $servicio['descripcion'] }}</p>

                        <div class="ct-service-card__image">
                            <img
                                src="{{ asset('images/tech/' . $servicio['imagen']) }}"
                                alt="{{ $servicio['alt'] }}"
                                width="1448"
                                height="1086"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>

                    </article>
                @endforeach
            </div>

        </div>
    </section>

    {{-- SISTEMAS / CARRUSEL --}}

    <section
        id="sistemas-tech"
        class="ct-section"
        aria-labelledby="ct-systems-title"
    >
        <div class="ct-shell">

            <div class="ct-section-heading">
                <div>
                    <p class="ct-eyebrow">Sistemas</p>

                    <h2 id="ct-systems-title" class="ct-title">
                        Sistemas para tu negocio
                    </h2>

                    <p class="ct-description">
                        Desarrollamos y personalizamos soluciones
                        según los procesos de tu empresa.
                    </p>
                </div>

                <button
                    type="button"
                    class="ct-text-button"
                    id="ct-open-catalog"
                    aria-haspopup="dialog"
                    aria-controls="ct-catalog"
                >
                    Ver todos los sistemas
                    <span aria-hidden="true">→</span>
                </button>
            </div>

            <div class="ct-carousel-wrapper">

                <button
                    type="button"
                    class="ct-carousel-arrow ct-carousel-arrow--previous"
                    id="ct-previous"
                    aria-label="Mostrar sistemas anteriores"
                    aria-controls="ct-systems-carousel"
                    disabled
                >
                    <span aria-hidden="true">‹</span>
                </button>

                <div
                    class="ct-carousel"
                    id="ct-systems-carousel"
                    role="region"
                    aria-label="Carrusel de sistemas para tu negocio"
                    tabindex="0"
                >
                    @foreach($sistemasTech as $sistema)
                        <article class="ct-system-card">

                            <img
                                src="{{ asset('images/tech/' . $sistema['imagen']) }}"
                                alt="{{ $sistema['alt'] }}"
                                class="ct-system-card__image"
                                width="1448"
                                height="1086"
                                loading="lazy"
                                decoding="async"
                            >

                            <div class="ct-system-card__body">
                                <h3>{{ $sistema['titulo'] }}</h3>

                                <p>{{ $sistema['descripcion'] }}</p>

                                <a
                                    href="{{ $crearEnlaceWhatsapp($sistema['mensaje']) }}"
                                    class="ct-button"
                                    aria-label="Consultar sobre {{ $sistema['titulo'] }}"
                                    @if($numeroWhatsapp !== '')
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    @endif
                                >
                                    Consultar sistema
                                    <span aria-hidden="true">→</span>
                                </a>
                            </div>

                        </article>
                    @endforeach
                </div>

                <button
                    type="button"
                    class="ct-carousel-arrow ct-carousel-arrow--next"
                    id="ct-next"
                    aria-label="Mostrar más sistemas"
                    aria-controls="ct-systems-carousel"
                >
                    <span aria-hidden="true">›</span>
                </button>

            </div>

<div
    class="ct-carousel-dots"
    id="ct-carousel-dots"
    role="group"
    aria-label="Posiciones del carrusel"
></div>

            <p class="ct-systems-note">
                ¿Tu actividad necesita algo distinto?
                También desarrollamos soluciones a medida.
            </p>

        </div>
    </section>

    {{-- SOLUCIÓN A MEDIDA --}}

    <section class="ct-custom" aria-labelledby="ct-custom-title">
        <div class="ct-shell">
            <div class="ct-custom__content">

                <p class="ct-eyebrow">Soluciones a tu medida</p>

                <h2 id="ct-custom-title" class="ct-title">
                    ¿Necesitas un sistema diferente?

                    <span class="ct-custom__highlight">
                        Diseñamos una solución a tu medida.
                    </span>
                </h2>

                <p class="ct-description">
                    Cuéntanos tu idea o proceso. Lo convertimos en
                    una herramienta que se adapte a tu negocio.
                </p>

                <a
                    href="{{ $enlaceCotizar }}"
                    class="ct-button"
                    @if($numeroWhatsapp !== '')
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif
                >
                    Cotizar mi proyecto
                    <span aria-hidden="true">→</span>
                </a>

            </div>
        </div>

        <img
            src="{{ asset('images/tech/medida.png') }}"
            alt="Concepto de un sistema personalizado con paneles de información"
            class="ct-custom__image"
            width="1672"
            height="941"
            loading="lazy"
            decoding="async"
        >
    </section>

    {{-- PROCESO --}}

    <section
        id="proceso-tech"
        class="ct-section ct-process"
        aria-labelledby="ct-process-title"
    >
        <div class="ct-shell">

            <p class="ct-eyebrow">Cómo trabajamos</p>

            <h2 id="ct-process-title" class="ct-title">
                Un proceso simple y transparente
            </h2>

            <div class="ct-process-grid">
                @foreach($pasosTech as $paso)
                    <article class="ct-process-step">

                        <span class="ct-process-step__number" aria-hidden="true">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <div>
                            <h3>{{ $paso['titulo'] }}</h3>
                            <p>{{ $paso['descripcion'] }}</p>
                        </div>

                    </article>
                @endforeach
            </div>

        </div>
    </section>

    {{-- PREGUNTAS FRECUENTES --}}

    <section class="ct-section" aria-labelledby="ct-faq-title">
        <div class="ct-shell">
            <div class="ct-faq-layout">

                <div>
                    <p class="ct-eyebrow">Preguntas frecuentes</p>

                    <h2 id="ct-faq-title" class="ct-title">
                        Resolvemos tus dudas
                    </h2>

                    <p class="ct-description">
                        Conoce cómo podemos ayudarte antes
                        de iniciar tu proyecto.
                    </p>
                </div>

                <div class="ct-faq-list">
                    @foreach($preguntasTech as $pregunta)
                        <details class="ct-faq-item">
                            <summary>
                                {{ $pregunta['pregunta'] }}
                            </summary>

                            <p>{{ $pregunta['respuesta'] }}</p>
                        </details>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- CONTACTO --}}

    <section
        id="contacto"
        class="ct-contact"
        aria-labelledby="ct-contact-title"
    >
        <div class="ct-shell">
            <div class="ct-contact__content">

                <p class="ct-eyebrow">Cuéntanos tu proyecto</p>

                <h2 id="ct-contact-title" class="ct-title">
                    Hablemos de tu proyecto
                </h2>

                <p class="ct-description">
                    Cuéntanos qué necesitas y te ayudaremos
                    a encontrar una solución para tu negocio.
                </p>

                @if($numeroWhatsapp !== '')
                    <div class="ct-actions">
                        <a
                            href="{{ $enlaceCotizar }}"
                            class="ct-button ct-button--whatsapp"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Escríbenos por WhatsApp
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                @endif

            </div>
        </div>

        <img
            src="{{ asset('images/tech/contacto.png') }}"
            alt="Concepto de oficina tecnológica con identidad Canvora Tech"
            class="ct-contact__image"
            width="1672"
            height="941"
            loading="lazy"
            decoding="async"
        >
    </section>

    {{-- CATÁLOGO COMPLETO --}}

    <dialog
        id="ct-catalog"
        class="ct-catalog"
        aria-labelledby="ct-catalog-title"
    >
        <div class="ct-catalog__header">
            <div>
                <p class="ct-eyebrow">Canvora Tech</p>

                <h2 id="ct-catalog-title" class="ct-title">
                    Sistemas para tu negocio
                </h2>

                <p class="ct-description">
                    Explora nuestras líneas de desarrollo.
                </p>
            </div>

            <button
                type="button"
                class="ct-catalog__close"
                id="ct-close-catalog"
                aria-label="Cerrar catálogo"
            >
                <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="ct-catalog-grid">
            @foreach($sistemasTech as $sistema)
                <article class="ct-system-card">

                    <img
                        src="{{ asset('images/tech/' . $sistema['imagen']) }}"
                        alt="{{ $sistema['alt'] }}"
                        class="ct-system-card__image"
                        width="1448"
                        height="1086"
                        loading="lazy"
                        decoding="async"
                    >

                    <div class="ct-system-card__body">
                        <h3>{{ $sistema['titulo'] }}</h3>

                        <p>{{ $sistema['descripcion'] }}</p>

                        <a
                            href="{{ $crearEnlaceWhatsapp($sistema['mensaje']) }}"
                            class="ct-button"
                            @if($numeroWhatsapp !== '')
                                target="_blank"
                                rel="noopener noreferrer"
                            @endif
                        >
                            Consultar sistema
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>

                </article>
            @endforeach
        </div>

        <p class="ct-systems-note">
            También podemos desarrollar un sistema específico
            para los procesos de tu empresa.
        </p>
    </dialog>

</div>

<script>
(() => {
    'use strict';

    function iniciarTech() {
        const carousel = document.getElementById('ct-systems-carousel');
        const previous = document.getElementById('ct-previous');
        const next = document.getElementById('ct-next');
        const dots = document.getElementById('ct-carousel-dots');

        const catalog = document.getElementById('ct-catalog');
        const openCatalog = document.getElementById('ct-open-catalog');
        const closeCatalog = document.getElementById('ct-close-catalog');

        const reducedMotion = window.matchMedia(
            '(prefers-reduced-motion: reduce)'
        );

        /* CARRUSEL */

        if (carousel) {
            const cards = [
                ...carousel.querySelectorAll('.ct-system-card')
            ];

            let positions = [0];
            let active = 0;
            let timer = null;
            let touching = false;
            let lastInteraction = 0;

            function update() {
                active = positions.reduce((best, position, index) => {
                    const distance = Math.abs(
                        position - carousel.scrollLeft
                    );

                    const bestDistance = Math.abs(
                        positions[best] - carousel.scrollLeft
                    );

                    return distance < bestDistance ? index : best;
                }, 0);

                const canMove = positions.length > 1;

                if (previous) previous.disabled = !canMove;
                if (next) next.disabled = !canMove;

                if (dots) {
                    [...dots.children].forEach((dot, index) => {
                        dot.setAttribute(
                            'aria-current',
                            String(index === active)
                        );
                    });
                }
            }

            function go(index) {
                const target = (
                    index + positions.length
                ) % positions.length;

                carousel.scrollTo({
                    left: positions[target],
                    behavior: reducedMotion.matches
                        ? 'instant'
                        : 'smooth'
                });
            }

            function start() {
                window.clearInterval(timer);

                timer = window.setInterval(() => {
                    const rect = carousel.getBoundingClientRect();

                    const keyboardFocus =
                        carousel.matches(':focus-visible') ||
                        carousel.querySelector(':focus-visible');

                    const shouldWait =
                        document.hidden ||
                        touching ||
                        catalog?.open ||
                        reducedMotion.matches ||
                        keyboardFocus ||
                        rect.bottom <= 0 ||
                        rect.top >= window.innerHeight ||
                        Date.now() - lastInteraction < 4000 ||
                        positions.length <= 1;

                    if (shouldWait) return;

                    update();
                    go(active + 1);
                }, 4000);
            }

            function manualGo(index) {
                lastInteraction = Date.now();
                go(index);
                start();
            }

            function layout() {
                if (!cards.length) return;

                const max = Math.max(
                    0,
                    carousel.scrollWidth - carousel.clientWidth
                );

                const firstLeft = cards[0]
                    .getBoundingClientRect().left;

                positions = [0];

                cards.forEach(card => {
                    const position = Math.min(
                        max,
                        Math.max(
                            0,
                            card.getBoundingClientRect().left - firstLeft
                        )
                    );

                    const exists = positions.some(
                        saved => Math.abs(saved - position) < 2
                    );

                    if (!exists) positions.push(position);
                });

                const hasEnd = positions.some(
                    saved => Math.abs(saved - max) < 2
                );

                if (!hasEnd) positions.push(max);

                if (dots) {
                    dots.replaceChildren();
                    dots.hidden = positions.length < 2;

                    positions.forEach((position, index) => {
                        const button = document.createElement('button');

                        button.type = 'button';
                        button.className = 'ct-carousel-dot';

                        button.setAttribute(
                            'aria-label',
                            'Ver posición ' + (index + 1)
                        );

                        button.setAttribute(
                            'aria-controls',
                            carousel.id
                        );

                        button.addEventListener('click', () => {
                            manualGo(index);
                        });

                        dots.appendChild(button);
                    });
                }

                update();
            }

            previous?.addEventListener('click', () => {
                update();
                manualGo(active - 1);
            });

            next?.addEventListener('click', () => {
                update();
                manualGo(active + 1);
            });

            carousel.addEventListener(
                'scroll',
                update,
                { passive: true }
            );

            carousel.addEventListener('pointerdown', () => {
                touching = true;
                lastInteraction = Date.now();
            }, { passive: true });

            function finishTouch() {
                if (!touching) return;

                touching = false;
                lastInteraction = Date.now();
                start();
            }

            window.addEventListener(
                'pointerup',
                finishTouch,
                { passive: true }
            );

            window.addEventListener(
                'pointercancel',
                finishTouch,
                { passive: true }
            );

            carousel.addEventListener('keydown', event => {
                if (event.target !== carousel) return;

                if (
                    event.key === 'ArrowRight' ||
                    event.key === 'ArrowLeft'
                ) {
                    event.preventDefault();
                    update();

                    manualGo(
                        active + (
                            event.key === 'ArrowRight' ? 1 : -1
                        )
                    );
                }
            });

            if ('ResizeObserver' in window) {
                new ResizeObserver(layout).observe(carousel);
            } else {
                window.addEventListener('resize', layout);
            }

            document.fonts?.ready.then(layout);

            document.addEventListener('visibilitychange', () => {
                touching = false;
                start();
            });

            layout();
            start();
        }

        /* CATÁLOGO: FUNCIONA INDEPENDIENTEMENTE DEL CARRUSEL */

        if (catalog && openCatalog && closeCatalog) {
            let oldOverflow = '';

            openCatalog.addEventListener('click', () => {
                if (catalog.open) return;

                oldOverflow = document.body.style.overflow;

                catalog.showModal();
                document.body.style.overflow = 'hidden';
            });

            closeCatalog.addEventListener('click', () => {
                catalog.close();
            });

            catalog.addEventListener('close', () => {
                document.body.style.overflow = oldOverflow;
                openCatalog.focus({ preventScroll: true });
            });

            catalog.addEventListener('click', event => {
                if (event.target !== catalog) return;

                const rect = catalog.getBoundingClientRect();

                const outside =
                    event.clientX < rect.left ||
                    event.clientX > rect.right ||
                    event.clientY < rect.top ||
                    event.clientY > rect.bottom;

                if (outside) catalog.close();
            });

            catalog.querySelectorAll(
                'a[href="#contacto"]'
            ).forEach(link => {
                link.addEventListener('click', () => {
                    catalog.close();
                });
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            iniciarTech,
            { once: true }
        );
    } else {
        iniciarTech();
    }
})();
</script>

@endsection