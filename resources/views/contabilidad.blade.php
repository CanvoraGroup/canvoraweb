@extends('layouts.web')

@section('titulo', 'Canvora Contabilidad | Contabilidad y formalización')

@section('descripcion', 'Contabilidad mensual, RUC y formalización, trámites SUNAT, declaraciones tributarias, planillas y asesoría contable.')

@section('contenido')
@php
    $numero = preg_replace(
        '/\D/',
        '',
        (string) config('canvora.whatsapp', '')
    );

    $consultar = function ($servicio = '') use ($numero) {
        if ($numero === '') {
            return route('inicio') . '#contacto';
        }

        $mensaje = $servicio !== ''
            ? "Hola, Canvora. Quisiera información sobre {$servicio}."
            : 'Hola, Canvora. Quisiera una cotización de servicios contables.';

        return 'https://wa.me/' . $numero
            . '?text=' . rawurlencode($mensaje);
    };

    $servicios = [
        [
            'nombre' => 'RUC y formalización',
            'descripcion' => 'Te orientamos en la inscripción al RUC y los pasos para iniciar tu negocio.',
            'icono' => 'document',
            'clase' => 'cc-service--ruc',
            'imagen' => 'ruc-formalizacion.png',
        ],
        [
            'nombre' => 'Trámites SUNAT',
            'descripcion' => 'Apoyo con Clave SOL, actualización de datos y gestiones según tu necesidad.',
            'icono' => 'document',
            'clase' => 'cc-service--sunat',
            'imagen' => null,
        ],
        [
            'nombre' => 'Contabilidad mensual',
            'descripcion' => 'Organizamos tus registros y documentos para una gestión contable ordenada.',
            'icono' => 'laptop',
            'clase' => 'cc-service--monthly',
            'imagen' => 'contabilidad-mensual.png',
        ],
        [
            'nombre' => 'Declaraciones tributarias',
            'descripcion' => 'Preparación y presentación de declaraciones según las obligaciones de tu negocio.',
            'icono' => 'document',
            'clase' => 'cc-service--tax',
            'imagen' => null,
        ],
        [
            'nombre' => 'Planillas',
            'descripcion' => 'Apoyo en la gestión de planillas y obligaciones laborales de tu equipo.',
            'icono' => 'document',
            'clase' => 'cc-service--payroll',
            'imagen' => null,
        ],
        [
            'nombre' => 'Asesoría contable',
            'descripcion' => 'Resolvemos tus consultas y te ayudamos a definir los siguientes pasos.',
            'icono' => 'chat',
            'clase' => 'cc-service--advice',
            'imagen' => null,
        ],
    ];

    $pasos = [
        [
            'titulo' => 'Cuéntanos tu situación',
            'descripcion' => 'Conocemos tu negocio, tus necesidades y el servicio que buscas.',
        ],
        [
            'titulo' => 'Te presentamos una propuesta',
            'descripcion' => 'Definimos el alcance, los documentos necesarios y la cotización.',
        ],
        [
            'titulo' => 'Coordinamos contigo',
            'descripcion' => 'Acordamos los siguientes pasos y cómo acompañarte durante el servicio.',
        ],
    ];

    $preguntas = [
        [
            'titulo' => '¿Puedo consultar si recién voy a iniciar mi negocio?',
            'respuesta' => 'Sí. Cuéntanos qué actividad realizarás y te orientaremos sobre el servicio de RUC y formalización que necesitas.',
        ],
        [
            'titulo' => '¿Puedo solicitar contabilidad todos los meses?',
            'respuesta' => 'Sí. Podemos evaluar una atención mensual según la actividad de tu negocio, el volumen de documentos y las obligaciones que deban atenderse.',
        ],
        [
            'titulo' => '¿Qué documentos debo enviar para una cotización?',
            'respuesta' => 'Para empezar, indícanos si ya tienes RUC, qué actividad realizas y qué servicio necesitas. Luego te confirmaremos la documentación necesaria.',
        ],
        [
            'titulo' => '¿También puedo consultar por planillas?',
            'respuesta' => 'Sí. Indícanos cuántos trabajadores tienes y qué apoyo necesitas para definir el alcance de la propuesta.',
        ],
        [
            'titulo' => '¿Inscribir el RUC es lo mismo que constituir una empresa?',
            'respuesta' => 'Son trámites distintos. Cuéntanos si quieres iniciar como persona natural o constituir una empresa para evaluar los pasos y las coordinaciones necesarias.',
        ],
        [
            'titulo' => '¿Cómo solicito una cotización?',
            'respuesta' => 'Selecciona el servicio que te interesa y escríbenos por WhatsApp. Revisaremos tu necesidad para presentarte una propuesta.',
        ],
    ];
@endphp

<div class="cc-page">

    {{-- PORTADA --}}
    <section class="cc-hero" aria-labelledby="cc-hero-title">
        <div class="cc-container">
            <div class="cc-hero__content">
                <p class="cc-eyebrow">CANVORA CONTABILIDAD</p>

                <h1 id="cc-hero-title">
                    Tú haces crecer tu negocio.
                    <span>Nosotros te ayudamos con las cuentas.</span>
                </h1>

                <p class="cc-hero__description">
                    Contabilidad, asesoría tributaria y formalización
                    para acompañarte en cada etapa de tu negocio.
                </p>

                <a
                    class="cc-button"
                    href="{{ $consultar() }}"
                    @if($numero !== '')
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif>
                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <use href="#icon-chat"/>
                    </svg>

                    Conversemos por WhatsApp

                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <use href="#icon-arrow"/>
                    </svg>
                </a>
            </div>

            <figure class="cc-hero__photo">
                <img
                    src="{{ asset('images/contabilidad/portada-contabilidad.png') }}"
                    alt="Profesional contable revisando documentos junto a un emprendedor"
                    fetchpriority="high"
                    decoding="async">
            </figure>
        </div>
    </section>

    {{-- SERVICIOS --}}
    <section
        class="cc-services"
        id="servicios-contables"
        aria-labelledby="cc-services-title">

        <div class="cc-container">
            <div class="cc-heading">
                <p class="cc-eyebrow">NUESTROS SERVICIOS</p>

                <h2 id="cc-services-title">
                    Soluciones contables para cada etapa de tu negocio
                </h2>
            </div>

            <div class="cc-services__grid">
                @foreach($servicios as $servicio)
                    <article class="cc-service {{ $servicio['clase'] }}">

                        @if($servicio['imagen'])
                            <img
                                class="cc-service__photo"
                                src="{{ asset('images/contabilidad/' . $servicio['imagen']) }}"
                                alt=""
                                loading="lazy"
                                decoding="async">
                        @endif

                        <div class="cc-service__content">
                            <span class="cc-service__icon">
                                <svg aria-hidden="true" viewBox="0 0 24 24">
                                    <use href="#icon-{{ $servicio['icono'] }}"/>
                                </svg>
                            </span>

                            <h3>{{ $servicio['nombre'] }}</h3>

                            <p>{{ $servicio['descripcion'] }}</p>

                            <a
                                class="cc-service__link"
                                href="{{ $consultar($servicio['nombre']) }}"
                                aria-label="Consultar sobre {{ $servicio['nombre'] }}"
                                @if($numero !== '')
                                    target="_blank"
                                    rel="noopener noreferrer"
                                @endif>
                                <svg aria-hidden="true" viewBox="0 0 24 24">
                                    <use href="#icon-arrow"/>
                                </svg>
                            </a>
                        </div>

                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PROCESO --}}
    <section class="cc-process" aria-labelledby="cc-process-title">
        <div class="cc-container cc-process__grid">

            <figure class="cc-process__photo">
                <img
                    src="{{ asset('images/contabilidad/atencion-personalizada.png') }}"
                    alt="Asesora contable conversando con un cliente sobre su negocio"
                    loading="lazy"
                    decoding="async">
            </figure>

            <div class="cc-process__content">
                <p class="cc-eyebrow">NUESTRO PROCESO</p>

                <h2 id="cc-process-title">
                    Una atención cercana, paso a paso
                </h2>

                <ol class="cc-steps">
                    @foreach($pasos as $paso)
                        <li class="cc-step">
                            <span class="cc-step__number" aria-hidden="true">
                                {{ $loop->iteration }}
                            </span>

                            <div>
                                <h3>{{ $paso['titulo'] }}</h3>
                                <p>{{ $paso['descripcion'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

        </div>
    </section>

    {{-- PREGUNTAS FRECUENTES --}}
    <section class="cc-faq" aria-labelledby="cc-faq-title">
        <div class="cc-container">
            <div class="cc-faq__panel">

                <div class="cc-heading">
                    <p class="cc-eyebrow">PREGUNTAS FRECUENTES</p>
                    <h2 id="cc-faq-title">Resolvemos tus dudas</h2>
                </div>

                <div class="cc-faq__grid">
                    @foreach($preguntas as $pregunta)
                        <details class="cc-faq__item">
                            <summary>{{ $pregunta['titulo'] }}</summary>
                            <p>{{ $pregunta['respuesta'] }}</p>
                        </details>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- CONTACTO --}}
    <section
        class="cc-contact"
        id="contacto-contabilidad"
        aria-labelledby="cc-contact-title">

        <div class="cc-container">
            <div class="cc-contact__panel">

                <img
                    class="cc-contact__background"
                    src="{{ asset('images/contabilidad/contacto-contabilidad.png') }}"
                    alt=""
                    loading="lazy"
                    decoding="async">

                <div class="cc-contact__content">
                    <p class="cc-eyebrow">CANVORA CONTABILIDAD</p>

                    <h2 id="cc-contact-title">
                        Hablemos de tu negocio
                    </h2>

                    <p>
                        Cuéntanos en qué etapa estás y qué necesitas.
                        Revisaremos contigo cómo podemos ayudarte.
                    </p>
                </div>

                <a
                    class="cc-button cc-button--white"
                    href="{{ $consultar() }}"
                    @if($numero !== '')
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif>
                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <use href="#icon-chat"/>
                    </svg>

                    Conversemos por WhatsApp

                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <use href="#icon-arrow"/>
                    </svg>
                </a>

            </div>
        </div>
    </section>

</div>
@endsection