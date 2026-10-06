@extends('layouts.web')

@section('titulo', 'CANVORA GROUP | Soluciones que impulsan tu negocio')

@section('descripcion', 'Tecnología, equipos, inflables publicitarios, marketing y servicios contables para tu negocio.')

@section('contenido')
    @php
        $numero = preg_replace('/\D/', '', config('canvora.whatsapp', ''));

        $enlaceGeneral = $numero !== ''
            ? 'https://wa.me/' . $numero . '?text=' .
              rawurlencode('Hola, quisiera solicitar una cotización a CANVORA GROUP.')
            : '#contacto';
    @endphp

    {{-- HERO 3D INTERACTIVO CON ROTACIÓN AUTOMÁTICA CADA 2 SEGUNDOS --}}
    <section class="hero hero-3d" id="nosotros" aria-labelledby="hero-title">
        {{-- Canvas de partículas 3D interactivo en segundo plano --}}
        <canvas id="hero-3d-canvas" aria-hidden="true"></canvas>

        {{-- Auras de iluminación ambiental --}}
        <div class="hero-aurora hero-aurora-1" aria-hidden="true"></div>
        <div class="hero-aurora hero-aurora-2" aria-hidden="true"></div>

        <div class="container hero-inner-3d">
            {{-- Columna izquierda: Información y llamado a la acción --}}
            <div class="hero-copy">
                <div class="hero-badge-pill">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    Ecosistema Empresarial 360°
                </div>

                <h1 id="hero-title" class="hero-title-modern">
                    Soluciones que <span class="text-gradient-cyan">impulsan</span> tu negocio.
                </h1>

                <p class="hero-desc-modern">
                    Tecnología avanzada, equipamiento corporativo, publicidad BTL de gran formato y servicios empresariales integrados para hacer crecer tu organización.
                </p>

                <div class="hero-cta-group">
                    <a class="button btn-primary-3d" href="#contacto">
                        Solicitar cotización
                        <svg aria-hidden="true">
                            <use href="#icon-arrow"/>
                        </svg>
                    </a>

                    <a
                        class="button btn-outline-3d"
                        href="{{ $enlaceGeneral }}"
                        @if($numero !== '')
                            target="_blank"
                            rel="noopener noreferrer"
                        @endif>
                        <svg aria-hidden="true" width="18" height="18">
                            <use href="#icon-chat"/>
                        </svg>
                        WhatsApp Directo
                    </a>
                </div>

                {{-- Métricas de confianza --}}
                <div class="hero-metrics-strip">
                    <div class="metric-pill">
                        <span class="metric-val">+10</span>
                        <span class="metric-lbl">Años de Trayectoria</span>
                    </div>
                    <div class="metric-pill">
                        <span class="metric-val">5</span>
                        <span class="metric-lbl">Divisiones Especializadas</span>
                    </div>
                    <div class="metric-pill">
                        <span class="metric-val">+500</span>
                        <span class="metric-lbl">Proyectos Completados</span>
                    </div>
                    <div class="metric-pill">
                        <span class="metric-val">100%</span>
                        <span class="metric-lbl">Atención Garantizada</span>
                    </div>
                </div>
            </div>

            {{-- Columna derecha: Escenario 3D interactivo con cambio cada 2 segundos y rotación al cursor --}}
            <div class="hero-3d-wrapper">
                {{-- Selector interactivo de áreas (cambia activo automáticamente cada 2 segundos) --}}
                <div class="hero-3d-tabs" role="tablist" aria-label="Especialidades en 3D">
                    <button class="tab-3d-btn active" data-area="general" type="button">General</button>
                    <button class="tab-3d-btn" data-area="tecnologia" type="button">Tech</button>
                    <button class="tab-3d-btn" data-area="store" type="button">Store</button>
                    <button class="tab-3d-btn" data-area="inflables" type="button">Inflables</button>
                    <button class="tab-3d-btn" data-area="marketing" type="button">Marketing</button>
                    <button class="tab-3d-btn" data-area="contabilidad" type="button">Contable</button>
                </div>

                {{-- Barra sutil de progreso del temporizador de 2 segundos --}}
                <div class="hero-3d-timer-bar-wrap" aria-hidden="true">
                    <div class="hero-3d-timer-bar" id="hero-3d-timer-bar"></div>
                </div>

                {{-- Escenario 3D con físicas de inclinación y arrastre --}}
                <div class="hero-3d-stage" id="hero-3d-stage" title="Mueve el cursor o arrastra para rotar en 3D">
                    {{-- Marco de cristal con brillo --}}
                    <div class="hero-3d-frame"></div>

                    {{-- Contenedor visual interior con profundidad y carga garantizada de imagen --}}
                    <div class="hero-3d-visual-inner">
                        <img
                            id="hero-3d-image"
                            src="{{ asset('images/portada.png') }}"
                            width="1672"
                            height="941"
                            alt="CANVORA GROUP Ecosistema"
                            fetchpriority="high">
                    </div>

                    {{-- Reflejo dinámico especular (sigue el cursor) --}}
                    <div class="hero-3d-glare" aria-hidden="true"></div>

                    {{-- Insignia 3D flotante superior --}}
                    <div class="floating-3d-badge floating-badge-top" aria-hidden="true">
                        <div class="badge-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </div>
                        <div>
                            <span id="hero-3d-badge-title">Canvora Group</span>
                        </div>
                    </div>

                    {{-- Insignia 3D flotante inferior --}}
                    <div class="floating-3d-badge floating-badge-bottom" aria-hidden="true">
                        <div class="badge-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                        </div>
                        <div>
                            <span id="hero-3d-badge-sub">Soluciones Integradas</span>
                        </div>
                    </div>

                    {{-- Chip de categoría 3D --}}
                    <div class="floating-3d-badge floating-badge-tag" aria-hidden="true">
                        <span id="hero-3d-badge-tag">5 Especialidades</span>
                    </div>

                    {{-- Botón interactivo de acción directa para la división activa --}}
                    <a id="hero-3d-action" href="#contacto" class="hero-3d-action-chip">
                        <span>Ver más detalles</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="hero-3d-hint">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/>
                    </svg>
                    <span>Cambia cada 2s • Arrastra o mueve el cursor en 3D</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Definición segura de URLs absolutas generadas por Laravel para cada imagen --}}
    <script>
        window.canvora3DAreas = [
            {
                key: 'general',
                title: 'Canvora Group',
                subtitle: 'Soluciones Integradas',
                tag: 'Ecosistema 360°',
                image: @json(asset('images/portada.png')),
                url: '#contacto'
            },
            {
                key: 'tecnologia',
                title: 'Canvora Tech',
                subtitle: 'Software & Automatización',
                tag: 'Desarrollo Web & Cloud',
                image: @json(asset('images/tecnologia.png')),
                url: @json(route('tecnologia'))
            },
            {
                key: 'store',
                title: 'Canvora Store',
                subtitle: 'Equipos & Accesorios',
                tag: 'Hardware Corporativo',
                image: @json(asset('images/equipos.png')),
                url: @json(route('store'))
            },
            {
                key: 'inflables',
                title: 'Inflables Publicitarios',
                subtitle: 'Gran Formato & BTL',
                tag: 'Alto Impacto Visual',
                image: @json(asset('images/inflables.png')),
                url: @json(route('inflables'))
            },
            {
                key: 'marketing',
                title: 'Marketing & Publicidad',
                subtitle: 'Branding & Campañas',
                tag: 'Estrategia Digital',
                image: @json(asset('images/marketing.png')),
                url: @json(route('marketing'))
            },
            {
                key: 'contabilidad',
                title: 'Servicios Contables',
                subtitle: 'Asesoría Tributaria',
                tag: 'Gestión Financiera',
                image: @json(asset('images/contabilidad.png')),
                url: @json(route('contabilidad'))
            }
        ];
    </script>

    {{-- PANEL 3D DEL ECOSISTEMA DE SOLUCIONES DE NEGOCIO EN 3D --}}
    <section class="experience-3d-section" id="soluciones" aria-labelledby="orbit-title">
        <div class="container">
            <div class="section-heading-3d">
                <p class="eyebrow">Nuestras soluciones</p>
                <h2 id="orbit-title" class="title-3d" style="color: #ffffff;">
                    Cinco áreas. Un mismo propósito.
                </h2>
                <p class="desc-3d" style="color: #94a3b8;">
                    Soluciones integradas para hacer crecer tu negocio.
                </p>
            </div>

            <div class="orbit-3d-container">
                <div class="orbit-3d-carousel" id="orbit-3d-carousel" title="Arrastra horizontalmente para girar en 3D">
                    {{-- Item 1: Tech --}}
                    <div class="orbit-3d-item">
                        <div class="item-visual">
                            <span class="item-tag">Canvora Tech</span>
                            <img src="{{ asset('images/tecnologia.png') }}" alt="Canvora Tech" loading="lazy">
                        </div>
                        <h4>Desarrollo & Software</h4>
                        <p>Plataformas web a medida, automatización empresarial y soluciones en la nube con alto rendimiento.</p>
                        <a href="{{ route('tecnologia') }}" class="item-link">
                            Explorar Canvora Tech
                            <svg aria-hidden="true" width="16" height="16"><use href="#icon-arrow"/></svg>
                        </a>
                    </div>

                    {{-- Item 2: Store --}}
                    <div class="orbit-3d-item">
                        <div class="item-visual">
                            <span class="item-tag">Canvora Store</span>
                            <img src="{{ asset('images/equipos.png') }}" alt="Canvora Store" loading="lazy">
                        </div>
                        <h4>Equipos & Hardware</h4>
                        <p>Balanzas comerciales, cómputo industrial, impresoras térmicas y suministros de alta durabilidad.</p>
                        <a href="{{ route('store') }}" class="item-link">
                            Explorar Canvora Store
                            <svg aria-hidden="true" width="16" height="16"><use href="#icon-arrow"/></svg>
                        </a>
                    </div>

                    {{-- Item 3: Inflables --}}
                    <div class="orbit-3d-item">
                        <div class="item-visual">
                            <span class="item-tag">Canvora Inflables</span>
                            <img src="{{ asset('images/inflables.png') }}" alt="Inflables publicitarios" loading="lazy">
                        </div>
                        <h4>Inflables de Gran Formato</h4>
                        <p>Arcos de meta, tótems luminosos, carpas publicitarias y réplicas inflables para activaciones de marca.</p>
                        <a href="{{ route('inflables') }}" class="item-link">
                            Explorar Inflables
                            <svg aria-hidden="true" width="16" height="16"><use href="#icon-arrow"/></svg>
                        </a>
                    </div>

                    {{-- Item 4: Marketing --}}
                    <div class="orbit-3d-item">
                        <div class="item-visual">
                            <span class="item-tag">Canvora Marketing</span>
                            <img src="{{ asset('images/marketing.png') }}" alt="Marketing y publicidad" loading="lazy">
                        </div>
                        <h4>Marketing & Publicidad</h4>
                        <p>Branding corporativo, diseño gráfico publicitario y gestión de campañas digitales orientadas a resultados.</p>
                        <a href="{{ route('marketing') }}" class="item-link">
                            Explorar Marketing
                            <svg aria-hidden="true" width="16" height="16"><use href="#icon-arrow"/></svg>
                        </a>
                    </div>

                    {{-- Item 5: Contabilidad --}}
                    <div class="orbit-3d-item">
                        <div class="item-visual">
                            <span class="item-tag">Canvora Contabilidad</span>
                            <img src="{{ asset('images/contabilidad.png') }}" alt="Servicios contables" loading="lazy">
                        </div>
                        <h4>Asesoría Contable & Tributaria</h4>
                        <p>Declaraciones mensuales, formalización RUC, planeamiento tributario y auditoría contable para tu tranquilidad.</p>
                        <a href="{{ route('contabilidad') }}" class="item-link">
                            Explorar Contabilidad
                            <svg aria-hidden="true" width="16" height="16"><use href="#icon-arrow"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Indicadores sutiles de rotación 3D (sin flechas) --}}
                <div class="orbit-controls">
                    <div class="orbit-dots" id="orbit-dots" role="tablist" aria-label="Indicadores del carrusel 3D"></div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.contacto')
@endsection