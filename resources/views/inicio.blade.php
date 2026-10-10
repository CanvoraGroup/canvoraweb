@php
$telefono = preg_replace(
'/\D/',
'',
(string) config('canvora.whatsapp', '51941765588')
);
if ($telefono === '') {
$telefono = '51941765588';
}
$whatsapp = 'https://wa.me/' . $telefono . '?text=' .
rawurlencode('Hola Canvora, quisiera cotizar mi proyecto.');
$areas = [
[
'key' => 'tech',
'label' => 'Tech',
'title' => 'Canvora Tech',
'description' => 'Software a medida, plataformas web y automatización para tu negocio.',
'image' => asset('images/canvora-tech.png'),
'alt' => 'Desarrollo de software y plataformas web',
'url' => url('/tecnologia'),
'button' => 'Explorar tecnología',
'icon' => 'monitor',
],
[
'key' => 'store',
'label' => 'Store',
'title' => 'Canvora Store',
'description' => 'Balanzas y equipos para las operaciones de tu negocio.',
'image' => asset('images/canvora-store.png'),
'alt' => 'Balanza comercial y selladora de bolsas',
'url' => url('/store'),
'button' => 'Explorar equipos',
'icon' => 'store',
],
[
'key' => 'inflables',
'label' => 'Inflables',
'title' => 'Canvora Inflables',
'description' => 'Venta y alquiler de inflables publicitarios para eventos y activaciones.',
'image' => asset('images/canvora-inflables.png'),
'alt' => 'Arco inflable publicitario azul de Canvora',
'url' => url('/inflables'),
'button' => 'Explorar inflables',
'icon' => 'arch',
],
[
'key' => 'marketing',
'label' => 'Marketing',
'title' => 'Canvora Marketing',
'description' => 'Diseño, contenido y campañas digitales para impulsar tu marca.',
'image' => asset('images/canvora-marketing.png'),
'alt' => 'Diseño de identidad visual y contenido publicitario',
'url' => url('/marketing'),
'button' => 'Explorar marketing',
'icon' => 'megaphone',
],
[
'key' => 'contabilidad',
'label' => 'Contabilidad',
'title' => 'Canvora Contabilidad',
'description' => 'Asesoría contable y tributaria para una gestión ordenada.',
'image' => asset('images/canvora-contabilidad.png'),
'alt' => 'Gestión de documentos y asesoría contable',
'url' => url('/contabilidad'),
'button' => 'Explorar contabilidad',
'icon' => 'chart',
],
];
@endphp
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CANVORA GROUP | Soluciones para hacer crecer tu negocio</title>
    <meta name="description" content="Software, equipos, inflables, marketing y contabilidad para tu empresa. Encuentra tu solución y cotiza con Canvora Group.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
    <script src="{{ asset('js/contacto.js') }}?v=3" defer></script>
    <script src="{{ asset('js/canvora-inflables.js') }}" defer></script>
    <script src="{{ asset('js/tech-v2.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}?v=laptop-12">
    <script src="{{ asset('js/inicio.js') }}?v=laptop-12" defer></script>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}?v=header-compartido-9">
</head>
<body>
    <a class="skip-link" href="#contenido">Saltar al contenido</a>
    {{-- Iconos reutilizables --}}
    <svg class="svg-library" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <symbol id="i-arrow" viewBox="0 0 24 24">
            <path d="M5 12h14m-6-6 6 6-6 6" />
        </symbol>
        <symbol id="i-left" viewBox="0 0 24 24">
            <path d="m15 5-7 7 7 7" />
        </symbol>
        <symbol id="i-right" viewBox="0 0 24 24">
            <path d="m9 5 7 7-7 7" />
        </symbol>
        <symbol id="i-monitor" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="13" rx="2" />
            <path d="M8 21h8m-4-5v5" />
        </symbol>
        <symbol id="i-store" viewBox="0 0 24 24">
            <path d="M4 10v11h16V10M2 10l3-7h14l3 7M2 10c0 3 4 3 4 0 0 3 4 3 4 0 0 3 4 3 4 0 0 3 4 3 4 0 0 3 4 3 4 0M9 21v-7h6v7" />
        </symbol>
        <symbol id="i-arch" viewBox="0 0 24 24">
            <path d="M3 21V8l5-5h8l5 5v13h-5V10H8v11H3Z" />
        </symbol>
        <symbol id="i-megaphone" viewBox="0 0 24 24">
            <path d="m4 9 15-5v16L4 15V9Zm3 7 2 5h3l-2-4M21 8v8M4 9H2v6h2" />
        </symbol>
        <symbol id="i-chart" viewBox="0 0 24 24">
            <path d="M3 21h18M4 17V9h4v8m2 0V4h4v13m2 0v-6h4v6" />
        </symbol>
        <symbol id="i-chat" viewBox="0 0 24 24">
            <path d="M21 11.5a9 9 0 0 1-13.5 7.8L3 21l1.6-4.7A9 9 0 1 1 21 11.5Z" />
            <path d="M8 7c0 5 4 9 8 9l1-3-3-1-1 1c-1.5-.5-2.5-1.5-3-3l1-1-1-2H8Z" />
        </symbol>
        <symbol id="i-pause" viewBox="0 0 24 24">
            <path d="M8 5v14M16 5v14" />
        </symbol>
        <symbol id="i-play" viewBox="0 0 24 24">
            <path d="m8 5 11 7-11 7V5Z" />
        </symbol>
        <symbol id="i-menu" viewBox="0 0 24 24">
            <path d="M3 6h18M3 12h18M3 18h18" />
        </symbol>
        <symbol id="i-close" viewBox="0 0 24 24">
            <path d="m6 6 12 12M6 18 18 6" />
        </symbol>
    </svg>
    {{-- CABECERA --}}
@include('partials.header')
    <main id="contenido">
        {{-- PORTADA CON LAPTOP --}}
        <section class="hero" id="inicio" aria-labelledby="hero-title">
            <div class="container hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow">Soluciones integradas</p>
                    <h1 id="hero-title">
                        Soluciones para hacer <span>crecer</span> tu negocio.
                    </h1>
                    <p class="hero-description">
                        Software, equipos, inflables, marketing y
                        contabilidad para tu empresa.
                    </p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer">
                            Cotizar mi proyecto
                            <svg class="icon">
                                <use href="#i-arrow" />
                            </svg>
                        </a>
                        <a class="button button-outline" href="#soluciones">
                            Explorar soluciones
                            <svg class="icon">
                                <use href="#i-arrow" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="laptop-area" id="laptop-area">
                    <div class="laptop-halo" aria-hidden="true"></div>
                    <div class="laptop laptop-fotografica" id="laptop">
                        <img class="laptop-photo-frame" src="{{ asset('images/laptop-canvora.png') }}" alt="" aria-hidden="true" width="1536" height="1024">
                        <div class="laptop-lid">
                            <span class="laptop-camera" aria-hidden="true"></span>
                            <div class="laptop-display" role="region" aria-roledescription="carrusel" aria-label="Servicios de Canvora" tabindex="0">
                                <div class="screen-slides" id="screen-slides">
                                    @foreach($areas as $area)
                                    <article class="screen-slide {{ $area['key'] === 'inflables' ? 'is-active' : '' }}" data-slide="{{ $area['key'] }}" aria-hidden="{{ $area['key'] === 'inflables' ? 'false' : 'true' }}" @if($area['key'] !=='inflables' ) inert @endif>
                                        <img class="screen-image" src="{{ $area['image'] }}" alt="{{ $area['alt'] }}" width="1672" height="941" @if($area['key']==='inflables' ) fetchpriority="high" @else loading="lazy" @endif>
                                        <div class="screen-copy">
                                            <h2>{{ $area['title'] }}</h2>
                                            <p>{{ $area['description'] }}</p>
                                            <a class="button button-primary screen-link" href="{{ $area['url'] }}" tabindex="{{ $area['key'] === 'inflables' ? '0' : '-1' }}">
                                                {{ $area['button'] }}
                                                <svg class="icon">
                                                    <use href="#i-arrow" />
                                                </svg>
                                            </a>
                                        </div>
                                    </article>
                                    @endforeach
                                </div>
                                <button class="round-button screen-pause" id="screen-pause" type="button" aria-label="Pausar presentación automática" aria-pressed="false">
                                    <svg class="icon">
                                        <use href="#i-pause" />
                                    </svg>
                                </button>
                                <button class="round-button screen-prev" type="button" aria-label="Servicio anterior en la laptop">
                                    <svg class="icon">
                                        <use href="#i-left" />
                                    </svg>
                                </button>
                                <button class="round-button screen-next" type="button" aria-label="Servicio siguiente en la laptop">
                                    <svg class="icon">
                                        <use href="#i-right" />
                                    </svg>
                                </button>
                                <div class="screen-progress" aria-hidden="true">
                                    <span id="screen-progress-fill"></span>
                                </div>
                                <div class="screen-tabs" aria-label="Seleccionar servicio en la laptop">
                                    @foreach($areas as $area)
                                    <button type="button" data-screen-select="{{ $area['key'] }}" class="{{ $area['key'] === 'inflables' ? 'is-active' : '' }}" aria-pressed="{{ $area['key'] === 'inflables' ? 'true' : 'false' }}">
                                        <svg class="icon">
                                            <use href="#i-{{ $area['icon'] }}" />
                                        </svg>
                                        <span>{{ $area['label'] }}</span>
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="laptop-base" aria-hidden="true">
                            <span class="laptop-trackpad"></span>
                            <span class="laptop-notch"></span>
                        </div>
                        <div class="laptop-shadow" aria-hidden="true"></div>
                    </div>
                    <p class="sr-only" id="screen-status" aria-live="polite"></p>
                </div>
            </div>
        </section>
        {{-- SOLUCIONES CON CARRUSEL 3D --}}
        <section class="solutions" id="soluciones" aria-labelledby="solutions-title">
            <div class="container">
                <div class="section-heading">
                    <p class="eyebrow">Nuestras soluciones</p>
                    <h2 id="solutions-title">¿Qué necesitas hoy?</h2>
                    <p>Cinco áreas. Un mismo propósito.</p>
                </div>
                <div class="solution-tabs" aria-label="Seleccionar área de negocio">
                    @foreach($areas as $area)
                    <button type="button" data-solution-select="{{ $area['key'] }}" class="{{ $area['key'] === 'marketing' ? 'is-active' : '' }}" aria-pressed="{{ $area['key'] === 'marketing' ? 'true' : 'false' }}">
                        <svg class="icon">
                            <use href="#i-{{ $area['icon'] }}" />
                        </svg>
                        {{ $area['label'] }}
                    </button>
                    @endforeach
                </div>
                <div class="coverflow" role="region" aria-roledescription="carrusel" aria-label="Soluciones de negocio" tabindex="0">
                    <button type="button" class="round-button coverflow-prev" aria-label="Solución anterior">
                        <svg class="icon">
                            <use href="#i-left" />
                        </svg>
                    </button>
                    <div class="coverflow-stage" id="coverflow-stage">
                        @foreach($areas as $index => $area)
                        <article class="solution-card {{ $index === 3 ? 'is-center' : ($index === 2 ? 'is-left' : ($index === 4 ? 'is-right' : 'is-hidden')) }}" data-card="{{ $area['key'] }}" aria-hidden="{{ $index >= 2 ? 'false' : 'true' }}" @if($index < 2) inert @endif>
                            <img src="{{ $area['image'] }}" alt="{{ $area['alt'] }}" width="1672" height="941" loading="lazy">
                            <div class="card-copy">
                                <h3>{{ $area['title'] }}</h3>
                                <p>{{ $area['description'] }}</p>
                                <a class="button card-link" href="{{ $area['url'] }}" tabindex="{{ $index >= 2 ? '0' : '-1' }}">
                                    {{ $area['button'] }}
                                    <svg class="icon">
                                        <use href="#i-arrow" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                        @endforeach
                    </div>
                    <button type="button" class="round-button coverflow-next" aria-label="Solución siguiente">
                        <svg class="icon">
                            <use href="#i-right" />
                        </svg>
                    </button>
                </div>
                <div class="coverflow-dots" aria-label="Posición del carrusel">
                    @foreach($areas as $area)
                    <button type="button" data-solution-dot="{{ $area['key'] }}" class="{{ $area['key'] === 'marketing' ? 'is-active' : '' }}" aria-label="Mostrar {{ $area['title'] }}" aria-pressed="{{ $area['key'] === 'marketing' ? 'true' : 'false' }}"></button>
                    @endforeach
                </div>
                <p class="sr-only" id="solutions-status" aria-live="polite"></p>
                <noscript>
                    <p class="no-script">
                        Activa JavaScript para girar el carrusel.
                        Puedes visitar todas las áreas aquí:
                        @foreach($areas as $area)
                        <a href="{{ $area['url'] }}">{{ $area['title'] }}</a>
                        @endforeach
                    </p>
                </noscript>
            </div>
        </section>
        {{-- PROCESO --}}
        <section class="process" id="nosotros" aria-labelledby="process-title">
            <div class="container process-inner">
                <div class="process-heading">
                    <p class="eyebrow">De tu idea a la solución</p>
                    <h2 id="process-title">Trabajamos contigo.</h2>
                </div>
                <ol class="process-list">
                    <li>
                        <span class="step-number">1</span>
                        <div>
                            <h3>Cuéntanos qué necesitas</h3>
                            <p>Te escuchamos y entendemos tu proyecto.</p>
                        </div>
                    </li>
                    <li>
                        <span class="step-number">2</span>
                        <div>
                            <h3>Recibe una propuesta</h3>
                            <p>
                                Una solución a tu medida, clara
                                y sin complicaciones.
                            </p>
                        </div>
                    </li>
                    <li>
                        <span class="step-number">3</span>
                        <div>
                            <h3>Coordinamos la entrega</h3>
                            <p>Acordamos los siguientes pasos contigo.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </section>
        {{-- CONTACTO --}}
        <section id="contacto" class="cv-contact" aria-labelledby="cv-contact-title">
            <div class="container cv-contact-container">
                <div class="cv-contact-scene">
                    <div class="cv-contact-stage">
                        <div class="cv-contact-card" id="contacto-card">
                            <div class="cv-contact-eyebrow">
                                <span aria-hidden="true">✦</span>
                                <span>Estamos para ayudarte</span>
                                <span class="cv-contact-line" aria-hidden="true"></span>
                            </div>
                            <h2 id="cv-contact-title">
                                Cuéntanos tu<br>
                                proyecto.
                            </h2>
                            <p class="cv-contact-description">
                                Encuentra la solución que tu negocio
                                necesita con Canvora Group.
                            </p>
                            <a class="cv-contact-button" href="https://wa.me/51941765588" target="_blank" rel="noopener noreferrer">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5Z" />
                                    <path d="M9 8c0 3.5 3.5 7 7 7l1-2-3-1-1 1-2-2 1-1-1-3-2 1Z" />
                                </svg>
                                <span>Hablemos por WhatsApp</span>
                                <svg class="cv-contact-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                            <a class="cv-contact-phone" href="tel:+51941765588">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2Z" />
                                </svg>
                                <span>941 765 588</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('partials.footer')
</body>
</html>
