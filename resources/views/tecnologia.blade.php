{{-- Usa aquí el nombre de tu layout compartido actual. --}}
@extends('layouts.web')

@section('titulo', 'Canvora Tech | Sistemas y desarrollo a medida')
@section('descripcion', 'Sistemas de facturación, inventarios, pesaje, odontología, gestión vehicular, páginas web, antivirus y desarrollo a medida.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tech-v2.css') }}?v=ct-v2-1">
@endpush

@push('scripts')
    <script src="{{ asset('js/tech-v2.js') }}?v=ct-v2-1" defer></script>
@endpush

@section('contenido')
@php
    $telefonoTech = preg_replace('/\D/', '', (string) config('canvora.whatsapp', '51941765588'));
    if ($telefonoTech === '') $telefonoTech = '51941765588';
    $cotizarTech = fn ($mensaje) => 'https://wa.me/' . $telefonoTech . '?text=' . rawurlencode($mensaje);
    $sistemasTech = [
        [
            'key' => 'facturacion',
            'titulo' => 'Facturación y ventas',
            'imagen' => 'ct-v2-facturacion.png',
            'alt' => 'Laptop con interfaz ilustrativa de facturación y comprobantes.',
            'resumen' => 'Emite comprobantes, gestiona clientes y controla tus ventas.',
            'detalle' => 'Organiza productos, cotizaciones, comprobantes, clientes y reportes de ventas.',
        ],
        [
            'key' => 'inventarios',
            'titulo' => 'Inventarios y almacenes',
            'imagen' => 'ct-v2-inventarios.png',
            'alt' => 'Cajas, estantería, lector de códigos y tablet para inventarios.',
            'resumen' => 'Controla stock, movimientos y alertas de stock mínimo.',
            'detalle' => 'Controla productos, entradas, salidas y existencias de tus almacenes.',
        ],
        [
            'key' => 'pesaje',
            'titulo' => 'Pesaje y balanzas',
            'imagen' => 'ct-v2-pesaje.png',
            'alt' => 'Balanza industrial con indicador digital y tablet de pesaje.',
            'resumen' => 'Integra balanzas, registra pesajes y genera tickets.',
            'detalle' => 'Registra entradas, salidas y pesos netos, con tickets y reportes de pesaje.',
        ],
        [
            'key' => 'odontologia',
            'titulo' => 'Gestión odontológica',
            'imagen' => 'ct-v2-odontologia.png',
            'alt' => 'Sillón dental azul y pantalla con interfaz odontológica ilustrativa.',
            'resumen' => 'Gestiona pacientes, citas, tratamientos y pagos.',
            'detalle' => 'Organiza pacientes, citas, historias clínicas, odontogramas, tratamientos y pagos.',
        ],
        [
            'key' => 'vehicular',
            'titulo' => 'Gestión vehicular',
            'imagen' => 'ct-v2-vehicular.png',
            'alt' => 'Camiones blancos junto a un panel ilustrativo de gestión de flotas.',
            'resumen' => 'Administra vehículos, documentos y mantenimientos.',
            'detalle' => 'Centraliza vehículos, conductores, documentos, vencimientos y mantenimientos.',
        ],
        [
            'key' => 'web',
            'titulo' => 'Web y tiendas online',
            'imagen' => 'ct-v2-web-tiendas.png',
            'alt' => 'Laptop y celular con tienda online, junto a bolsas azules.',
            'resumen' => 'Presenta tu negocio y tus productos en internet.',
            'detalle' => 'Creamos páginas corporativas, catálogos y tiendas adaptadas a celular y escritorio.',
        ],
    ];
    $destacadosTech = collect($sistemasTech)->keyBy('key');
    $ordenTech = ['inventarios', 'odontologia', 'facturacion', 'pesaje', 'vehicular', 'web'];
@endphp

<div id="ct-tech" class="ct2-page">
    <svg width="0" height="0" aria-hidden="true" style="position:absolute;overflow:hidden">
        <symbol id="ct2-arrow" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"/>
        </symbol>
        <symbol id="ct2-left" viewBox="0 0 24 24">
            <path d="m15 6-6 6 6 6"/>
        </symbol>
        <symbol id="ct2-right" viewBox="0 0 24 24">
            <path d="m9 6 6 6-6 6"/>
        </symbol>
    </svg>

    {{-- PORTADA: LA IMAGEN ES UN RECURSO; LOS TEXTOS SON HTML. --}}
    <section class="ct2-hero" aria-labelledby="ct2-title">
        <div class="ct2-container ct2-hero-grid">
            <div class="ct2-hero-copy">
                <p class="ct2-eyebrow">Canvora Tech</p>
                <h1 id="ct2-title">¿Qué necesita<br><span>tu negocio?</span></h1>
                <p class="ct2-description">
                    Encuentra tu sistema o cuéntanos tu idea.
                    Desarrollamos, implementamos y damos soporte
                    a soluciones tecnológicas que impulsan tu empresa.
                </p>
                <div class="ct2-actions">
                    <a class="ct2-button ct2-button-primary" href="{{ $cotizarTech('Hola Canvora Tech, quiero cotizar un proyecto.') }}" target="_blank" rel="noopener noreferrer">
                        Cotizar mi proyecto
                        <svg class="ct2-icon" width="22" height="22" aria-hidden="true"><use href="#ct2-arrow"/></svg>
                    </a>
                    <a class="ct2-button ct2-button-outline" href="#ct2-sistemas">Ver todos los sistemas</a>
                </div>
                <ul class="ct2-benefits" aria-label="Cómo trabajamos">
                    <li><strong>Soluciones a medida</strong><span>Para empresas de todos los tamaños</span></li>
                    <li><strong>Implementación guiada</strong><span>Te acompañamos en cada etapa</span></li>
                    <li><strong>Soporte continuo</strong><span>Tu negocio siempre operativo</span></li>
                </ul>
            </div>
            <div class="ct2-hero-scene" data-ct2-tilt>
                <div class="ct2-hero-glow" aria-hidden="true"></div>
                <img class="ct2-hero-image" src="{{ asset('images/tech/ct-v2-portada.png') }}" 
                alt="Laptop con panel de gestión, cajas, lector de códigos, vehículos y un símbolo dental."
                 width="1536" height="1024" fetchpriority="high" decoding="async" draggable="false">
            </div>
        </div>
    </section>

    {{-- SEIS CATEGORÍAS, CON INCLINACIÓN 3D AL INTERACTUAR. --}}
    <section id="ct2-sistemas" class="ct2-systems" aria-labelledby="ct2-systems-title">
        <div class="ct2-container">
            <h2 id="ct2-systems-title" class="ct2-sr-only">Sistemas para tu negocio</h2>
            <div class="ct2-system-grid">
                @foreach($sistemasTech as $sistema)
                    <a class="ct2-system-card" data-ct2-tilt href="{{ $cotizarTech('Hola Canvora Tech, quiero información sobre ' . $sistema['titulo'] . '.') }}" target="_blank" rel="noopener noreferrer">
                        <div class="ct2-system-image">
                            <img src="{{ asset('images/tech/' . $sistema['imagen']) }}" alt="{{ $sistema['alt'] }}" width="1536" height="1024" loading="lazy" decoding="async">
                        </div>
                        <div class="ct2-system-copy">
                            <h3>{{ $sistema['titulo'] }}</h3>
                            <p>{{ $sistema['resumen'] }}</p>
                            <span class="ct2-card-arrow" aria-hidden="true"><svg class="ct2-icon" width="20" height="20"><use href="#ct2-arrow"/></svg></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CARRUSEL 3D: CENTRO, IZQUIERDA Y DERECHA. --}}
    <section class="ct2-featured" aria-labelledby="ct2-featured-title">
        <div class="ct2-container">
            <div class="ct2-featured-panel">
                <div class="ct2-featured-heading">
                    <p class="ct2-eyebrow">Sistemas destacados</p>
                    <h2 id="ct2-featured-title">Explora nuestros<br><span>sistemas</span></h2>
                    <p>Soluciones para organizar y hacer crecer tu negocio.</p>
                </div>
                <div class="ct2-carousel" data-ct2-carousel role="region" aria-roledescription="carrusel" aria-label="Sistemas destacados" tabindex="0">
                    <button class="ct2-carousel-arrow ct2-carousel-prev" type="button" data-ct2-prev aria-label="Sistema anterior">
                        <svg class="ct2-icon" width="24" height="24" aria-hidden="true"><use href="#ct2-left"/></svg>
                    </button>
                    <div class="ct2-carousel-stage" data-ct2-stage>
                        @foreach($ordenTech as $key)
                            @php
                                $sistema = $destacadosTech[$key];
                                $posicion = $loop->index === 1 ? 'is-center' : ($loop->index === 0 ? 'is-left' : ($loop->index === 2 ? 'is-right' : 'is-hidden'));
                            @endphp
                            <article class="ct2-feature-card {{ $posicion }}" data-ct2-slide="{{ $key }}" role="group" aria-roledescription="diapositiva" aria-label="{{ $loop->iteration }} de {{ count($ordenTech) }}: {{ $sistema['titulo'] }}" aria-hidden="{{ $loop->index > 2 ? 'true' : 'false' }}" @if($loop->index > 2) inert @endif>
                                <img src="{{ asset('images/tech/' . $sistema['imagen']) }}" alt="{{ $sistema['alt'] }}" width="1536" height="1024" loading="lazy" decoding="async">
                                <div class="ct2-feature-copy">
                                    <h3>{{ $sistema['titulo'] }}</h3>
                                    <p>{{ $sistema['detalle'] }}</p>
                                    <a class="ct2-button ct2-feature-link" href="{{ $cotizarTech('Hola Canvora Tech, quiero conocer el sistema de ' . $sistema['titulo'] . '.') }}" target="_blank" rel="noopener noreferrer" @if($loop->index > 2) tabindex="-1" @endif>
                                        Consultar sistema
                                        <svg class="ct2-icon" width="20" height="20" aria-hidden="true"><use href="#ct2-arrow"/></svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <button class="ct2-carousel-arrow ct2-carousel-next" type="button" data-ct2-next aria-label="Sistema siguiente">
                        <svg class="ct2-icon" width="24" height="24" aria-hidden="true"><use href="#ct2-right"/></svg>
                    </button>
                    <div class="ct2-carousel-dots" aria-label="Seleccionar sistema">
                        @foreach($ordenTech as $key)
                            <button type="button" data-ct2-select="{{ $key }}" class="{{ $loop->index === 1 ? 'is-active' : '' }}" aria-label="Mostrar {{ $destacadosTech[$key]['titulo'] }}" aria-pressed="{{ $loop->index === 1 ? 'true' : 'false' }}"></button>
                        @endforeach
                    </div>
                    <p class="ct2-sr-only" data-ct2-status aria-live="polite"></p>
                </div>
            </div>
        </div>
    </section>

    {{-- ANTIVIRUS, MANTENIMIENTO Y SOPORTE. --}}
    <section class="ct2-support" aria-labelledby="ct2-support-title">
        <div class="ct2-container">
            <div class="ct2-support-panel">
                <img class="ct2-support-image" src="{{ asset('images/tech/ct-v2-antivirus.png') }}" alt="Escudo azul de protección junto a una laptop y un servidor." width="1536" height="1024" loading="lazy" decoding="async">
                <div class="ct2-support-copy">
                    <p class="ct2-eyebrow">Soporte y protección</p>
                    <h2 id="ct2-support-title">Tu negocio siempre seguro y operativo</h2>
                    <p>Instalación de antivirus, mantenimiento preventivo y soporte técnico especializado.</p>
                </div>
                <ul class="ct2-support-services">
                    <li><strong>Instalación de antivirus</strong><span>Protección para tus equipos</span></li>
                    <li><strong>Mantenimiento</strong><span>Cuida el rendimiento de tu sistema</span></li>
                    <li><strong>Soporte técnico</strong><span>Ayuda para resolver incidencias</span></li>
                </ul>
                <a class="ct2-button ct2-button-primary" href="{{ $cotizarTech('Hola Canvora Tech, necesito antivirus, mantenimiento o soporte técnico.') }}" target="_blank" rel="noopener noreferrer">Consultar servicio</a>
            </div>
        </div>
    </section>

    {{-- DESARROLLO A MEDIDA Y PROCESO. --}}
    <section id="ct2-medida" class="ct2-custom" aria-labelledby="ct2-custom-title">
        <div class="ct2-container">
            <div class="ct2-custom-panel">
                <div class="ct2-custom-scene" data-ct2-tilt>
                    <img src="{{ asset('images/tech/ct-v2-medida.png') }}" alt="Laptop con editor de código e ilustraciones de nube y base de datos." width="1536" height="1024" loading="lazy" decoding="async">
                </div>
                <div class="ct2-custom-copy">
                    <p class="ct2-eyebrow">Desarrollo a medida</p>
                    <h2 id="ct2-custom-title">¿Necesitas otro sistema?<br><span>Lo desarrollamos a tu medida.</span></h2>
                    <p>Cuéntanos tu idea y la convertimos en una solución para tu negocio.</p>
                    <a class="ct2-button ct2-button-primary" href="{{ $cotizarTech('Hola Canvora Tech, quiero desarrollar un sistema a medida.') }}" target="_blank" rel="noopener noreferrer">Cotizar desarrollo</a>
                </div>
                <ol class="ct2-process" aria-label="Proceso de desarrollo">
                    <li><span class="ct2-step-number" aria-hidden="true">1</span><strong>Consulta</strong><p>Nos cuentas tu idea y tus necesidades.</p></li>
                    <li><span class="ct2-step-number" aria-hidden="true">2</span><strong>Propuesta</strong><p>Definimos la solución y su alcance.</p></li>
                    <li><span class="ct2-step-number" aria-hidden="true">3</span><strong>Desarrollo</strong><p>Construimos y validamos tu sistema.</p></li>
                    <li><span class="ct2-step-number" aria-hidden="true">4</span><strong>Entrega</strong><p>Implementamos y te acompañamos.</p></li>
                </ol>
            </div>
        </div>
    </section>
</div>
@endsection
