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

        $servicios = [
            [
                'nombre' => 'Canvora Tech',
                'imagen' => 'tecnologia.png',
                'descripcion' => 'Software, desarrollo web y automatización para una operación más eficiente.',
                'icono' => 'laptop',
                'consulta' => 'tecnología y desarrollo de software',
                'ruta' => 'tecnologia',
            ],
            [
                'nombre' => 'Canvora Store',
                'imagen' => 'equipos.png',
                'descripcion' => 'Computadoras, impresoras y accesorios para equipar tu empresa.',
                'icono' => 'cart',
                'consulta' => 'equipos y accesorios tecnológicos',
                'ruta' => 'store',
            ],
            [
                'nombre' => 'Inflables publicitarios',
                'imagen' => 'inflables.png',
                'descripcion' => 'Arcos y globos inflables de gran formato para eventos promocionales e inmobiliarios.',
                'icono' => 'megaphone',
                'consulta' => 'inflables publicitarios',
                'ruta' => 'inflables',
            ],
            [
                'nombre' => 'Marketing y publicidad',
                'imagen' => 'marketing.png',
                'descripcion' => 'Branding, diseño y campañas para que tu marca llegue más lejos.',
                'icono' => 'pencil',
                'consulta' => 'marketing y publicidad',
                'ruta' => 'marketing',
            ],
            [
                'nombre' => 'Servicios contables',
                'imagen' => 'contabilidad.png',
                'descripcion' => 'Contabilidad y asesoría tributaria para una gestión segura y ordenada.',
                'icono' => 'document',
                'consulta' => 'servicios contables',
                'ruta' => 'contabilidad',
            ],
        ];
    @endphp

    <section class="hero" aria-labelledby="hero-title">
        <div class="hero-visual">
            <img
                src="{{ asset('images/portada.png') }}"
                width="1672"
                height="941"
                alt="Tecnología, publicidad y servicios empresariales"
                fetchpriority="high">
        </div>

        <div class="container hero-inner">
            <div class="hero-copy">
                <h1 id="hero-title">
                    Soluciones que impulsan tu negocio.
                </h1>

                <p class="hero-description">
                    Tecnología, equipos, publicidad
                    y servicios empresariales.
                </p>

                <div class="hero-actions">
                    <a class="button" href="#soluciones">
                        Ver soluciones
                        <svg aria-hidden="true">
                            <use href="#icon-arrow"/>
                        </svg>
                    </a>

                    <a
                        class="button button-outline"
                        href="{{ $enlaceGeneral }}"
                        @if($numero !== '')
                            target="_blank"
                            rel="noopener noreferrer"
                        @endif>
                        Solicitar cotización
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section
        class="solutions"
        id="soluciones"
        aria-labelledby="solutions-title">

        <div class="container">
            <div class="section-heading" id="nosotros">
                <p class="eyebrow">Nuestras soluciones</p>

                <h2 id="solutions-title">
                    Cinco áreas. Un mismo propósito.
                </h2>

                <p class="section-description">
                    Soluciones integradas para hacer crecer tu negocio.
                </p>
            </div>

            <div class="services-grid">
                @foreach($servicios as $servicio)
                    @php
                        $abreWhatsApp = $servicio['ruta'] === null && $numero !== '';

                        $enlaceServicio = $servicio['ruta'] !== null
                            ? route($servicio['ruta'])
                            : ($numero !== ''
                                ? 'https://wa.me/' . $numero . '?text=' .
                                  rawurlencode(
                                      'Hola, quisiera información sobre ' .
                                      $servicio['consulta'] . ' de CANVORA GROUP.'
                                  )
                                : '#contacto');
                    @endphp

                    <article class="service-card">
                        <div class="service-photo">
                            <img
                                src="{{ asset('images/' . $servicio['imagen']) }}"
                                width="1448"
                                height="1086"
                                alt="{{ $servicio['nombre'] }}"
                                loading="lazy"
                                decoding="async">
                        </div>

                        <div class="service-body">
                            <span class="service-icon" aria-hidden="true">
                                <svg>
                                    <use href="#icon-{{ $servicio['icono'] }}"/>
                                </svg>
                            </span>

                            <h3>{{ $servicio['nombre'] }}</h3>

                            <p>{{ $servicio['descripcion'] }}</p>

                            <a
                                class="service-link"
                                href="{{ $enlaceServicio }}"
                                aria-label="{{ $servicio['ruta'] ? 'Ver' : 'Consultar' }} {{ $servicio['nombre'] }}"
                                @if($abreWhatsApp)
                                    target="_blank"
                                    rel="noopener noreferrer"
                                @endif>

                                {{ $servicio['ruta'] ? 'Ver soluciones' : 'Consultar' }}

                                <svg aria-hidden="true">
                                    <use href="#icon-arrow"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.contacto')
@endsection