@extends('layouts.web')

@section('titulo', 'Canvora Marketing | Ideas que conectan')

@section('descripcion', 'Gestión de redes sociales, contenido, Google Ads, diseño gráfico, merchandising y estrategias comerciales para tu negocio.')

@section('contenido')
@php
    $numero = preg_replace(
        '/\D/',
        '',
        (string) config('canvora.whatsapp', '')
    );

    $cotizar = function ($servicio = '') use ($numero) {
        if ($numero === '') {
            return route('inicio') . '#contacto';
        }

        $mensaje = $servicio !== ''
            ? "Hola, Canvora. Quisiera cotizar el servicio de {$servicio}."
            : 'Hola, Canvora. Quisiera cotizar un proyecto de marketing.';

        return 'https://wa.me/' . $numero
            . '?text=' . rawurlencode($mensaje);
    };

    $servicios = [
        [
            'nombre' => 'Gestión de redes sociales',
            'descripcion' => 'Planificamos el contenido y gestionamos tus publicaciones para mantener tu marca activa y conectar con tu comunidad.',
            'imagen' => 'gestion-redes-sociales.png',
            'clase' => 'cm-service--social',
            'canales' => null,
        ],
        [
            'nombre' => 'Creación de contenido',
            'descripcion' => 'Fotografías, videos, reels y textos que muestran lo mejor de tu negocio.',
            'imagen' => 'creacion-contenido.png',
            'clase' => 'cm-service--content',
            'canales' => null,
        ],
        [
            'nombre' => 'Publicidad digital',
            'descripcion' => 'Creamos y gestionamos campañas para dar visibilidad a tu marca y atraer clientes potenciales.',
            'imagen' => 'publicidad-digital.png',
            'clase' => 'cm-service--ads',
            'canales' => 'Google Ads · Facebook · Instagram',
        ],
        [
            'nombre' => 'Diseño gráfico e identidad corporativa',
            'descripcion' => 'Logos, identidad visual y piezas gráficas que dan una imagen coherente a tu marca.',
            'imagen' => 'diseno-identidad.png',
            'clase' => 'cm-service--design',
            'canales' => null,
        ],
        [
            'nombre' => 'Merchandising e impresión publicitaria',
            'descripcion' => 'Artículos personalizados, tarjetas, flyers, banners y materiales para promocionar tu negocio.',
            'imagen' => 'merchandising-impresion.png',
            'clase' => 'cm-service--merch',
            'canales' => null,
        ],
        [
            'nombre' => 'Estrategia de marketing y desarrollo comercial',
            'descripcion' => 'Definimos acciones para posicionar tu negocio, llegar a tus clientes y apoyar tus objetivos de venta.',
            'imagen' => 'estrategia-marketing.png',
            'clase' => 'cm-service--strategy',
            'canales' => null,
        ],
    ];

    $ejemplos = [
        [
            'nombre' => 'Contenido para redes sociales',
            'descripcion' => 'Concepto visual de contenido para una cafetería.',
            'imagen' => 'ejemplo-contenido.png',
            'consulta' => 'Creación de contenido',
        ],
        [
            'nombre' => 'Identidad visual y diseño gráfico',
            'descripcion' => 'Concepto de marca aplicado a empaques y materiales.',
            'imagen' => 'ejemplo-identidad.png',
            'consulta' => 'Diseño gráfico e identidad corporativa',
        ],
        [
            'nombre' => 'Campañas y piezas publicitarias',
            'descripcion' => 'Concepto visual de una pieza para publicidad exterior.',
            'imagen' => 'ejemplo-campana.png',
            'consulta' => 'Diseño de piezas publicitarias',
        ],
    ];

    $pasos = [
        [
            'titulo' => 'Conversamos sobre tu marca',
            'descripcion' => 'Conocemos tu negocio, tus objetivos y el público al que quieres llegar.',
            'icono' => 'chat',
        ],
        [
            'titulo' => 'Diseñamos la propuesta',
            'descripcion' => 'Definimos el enfoque, los entregables, los canales y el presupuesto.',
            'icono' => 'document',
        ],
        [
            'titulo' => 'Creamos y ejecutamos',
            'descripcion' => 'Desarrollamos las piezas y coordinamos contigo su revisión y publicación.',
            'icono' => 'pencil',
        ],
        [
            'titulo' => 'Revisamos y mejoramos',
            'descripcion' => 'Evaluamos el trabajo y, en las campañas, revisamos resultados para realizar ajustes.',
            'icono' => 'laptop',
        ],
    ];

    $preguntas = [
        [
            'titulo' => '¿Puedo contratar un solo servicio?',
            'respuesta' => 'Sí. Puedes solicitar una pieza de diseño, contenido, una campaña o una propuesta que combine varios servicios.',
        ],
        [
            'titulo' => '¿También trabajan con negocios que recién empiezan?',
            'respuesta' => 'Sí. Cuéntanos tu idea y qué necesitas para empezar. Podemos evaluar una propuesta de identidad visual, contenido y materiales para tu lanzamiento.',
        ],
        [
            'titulo' => '¿Gestionan campañas en Google Ads?',
            'respuesta' => 'Sí. Evaluamos tus objetivos, el público y el presupuesto para definir una propuesta de campaña en Google Ads. También puedes consultar por publicidad en Facebook e Instagram.',
        ],
        [
            'titulo' => '¿La cotización incluye el dinero destinado a los anuncios?',
            'respuesta' => 'El servicio de gestión y la inversión en anuncios se detallan por separado en la propuesta, para que conozcas el alcance de cada importe.',
        ],
        [
            'titulo' => '¿Puedo consultar por videos y fotografías?',
            'respuesta' => 'Sí. Indícanos qué productos o servicios quieres mostrar, dónde se realizaría el contenido y qué formatos necesitas.',
        ],
        [
            'titulo' => '¿Cómo cotizan el merchandising y la impresión?',
            'respuesta' => 'Cuéntanos qué artículo o material necesitas, las cantidades, medidas y fecha de entrega. Con esa información revisaremos las opciones y prepararemos la cotización.',
        ],
    ];
@endphp

<div class="cm-page">

    {{-- PORTADA --}}
    <section class="cm-hero" aria-labelledby="cm-hero-title">
        <div class="cm-container cm-hero__panel">

            <img
                class="cm-hero__image"
                src="{{ asset('images/marketing/portada-marketing.png') }}"
                alt="Equipo creativo revisando propuestas de identidad visual"
                fetchpriority="high"
                decoding="async">

            <div class="cm-hero__content">
                <p class="cm-eyebrow">CANVORA MARKETING</p>

                <h1 id="cm-hero-title">
                    Tu marca merece ser vista.
                    <span>Hagamos que conecte.</span>
                </h1>

                <p class="cm-hero__description">
                    Estrategia, creatividad y contenido para dar
                    presencia a tu marca en el mundo digital y físico.
                </p>

                <a
                    class="cm-button"
                    href="{{ $cotizar() }}"
                    @if($numero !== '')
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif>
                    Cotizar mi proyecto

                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <use href="#icon-arrow"/>
                    </svg>
                </a>
            </div>

        </div>
    </section>

    {{-- SERVICIOS --}}
    <section
        class="cm-services"
        id="servicios-marketing"
        aria-labelledby="cm-services-title">

        <div class="cm-container">
            <div class="cm-heading cm-heading--split">
                <div>
                    <p class="cm-eyebrow">NUESTRAS SOLUCIONES</p>

                    <h2 id="cm-services-title">
                        Todo lo que tu marca necesita,
                        en un solo lugar.
                    </h2>
                </div>

                <p class="cm-heading__description">
                    Creatividad, estrategia y ejecución para
                    ayudarte a comunicar, conectar y crecer.
                </p>
            </div>

            <div class="cm-services__grid">
                @foreach($servicios as $servicio)
                    <article class="cm-service {{ $servicio['clase'] }}">

                        <img
                            class="cm-service__image"
                            src="{{ asset('images/marketing/' . $servicio['imagen']) }}"
                            alt=""
                            loading="lazy"
                            decoding="async">

                        <div class="cm-service__content">
                            <span class="cm-service__number">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <h3>{{ $servicio['nombre'] }}</h3>

                            @if($servicio['canales'])
                                <p class="cm-service__channels">
                                    {{ $servicio['canales'] }}
                                </p>
                            @endif

                            <p class="cm-service__description">
                                {{ $servicio['descripcion'] }}
                            </p>

                            <a
                                class="cm-circle-link"
                                href="{{ $cotizar($servicio['nombre']) }}"
                                aria-label="Cotizar {{ $servicio['nombre'] }}"
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

    {{-- EJEMPLOS VISUALES --}}
    <section
        class="cm-examples"
        id="ejemplos-marketing"
        aria-labelledby="cm-examples-title">

        <div class="cm-container">
            <div class="cm-heading">
                <h2 id="cm-examples-title">Ejemplos visuales</h2>

                <p class="cm-heading__description">
                    Conceptos ilustrativos de diseño y contenido
                    para mostrar posibles aplicaciones.
                </p>
            </div>

            <div class="cm-examples__grid">
                @foreach($ejemplos as $ejemplo)
                    <article class="cm-example">

                        <img
                            src="{{ asset('images/marketing/' . $ejemplo['imagen']) }}"
                            alt="{{ $ejemplo['descripcion'] }}"
                            loading="lazy"
                            decoding="async">

                        <span class="cm-example__badge">
                            Concepto visual
                        </span>

                        <div class="cm-example__content">
                            <h3>{{ $ejemplo['nombre'] }}</h3>

                            <a
                                class="cm-circle-link"
                                href="{{ $cotizar($ejemplo['consulta']) }}"
                                aria-label="Consultar sobre {{ $ejemplo['nombre'] }}"
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
    <section class="cm-process" aria-labelledby="cm-process-title">
        <div class="cm-container cm-process__grid">

            <figure class="cm-process__photo">
                <img
                    src="{{ asset('images/marketing/proceso-marketing.png') }}"
                    alt="Equipo creativo colaborando en una propuesta de marketing"
                    loading="lazy"
                    decoding="async">
            </figure>

            <div class="cm-process__content">
                <p class="cm-eyebrow">NUESTRO PROCESO</p>

                <h2 id="cm-process-title">
                    De la idea a una marca con presencia.
                </h2>

                <p class="cm-process__description">
                    Un proceso claro y colaborativo
                    para dar forma a tu proyecto.
                </p>

                <ol class="cm-steps">
                    @foreach($pasos as $paso)
                        <li class="cm-step">
                            <span class="cm-step__icon">
                                <svg aria-hidden="true" viewBox="0 0 24 24">
                                    <use href="#icon-{{ $paso['icono'] }}"/>
                                </svg>
                            </span>

                            <div>
                                <h3>
                                    <span class="cm-step__number">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                    {{ $paso['titulo'] }}
                                </h3>

                                <p>{{ $paso['descripcion'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

        </div>
    </section>

    {{-- PREGUNTAS Y CONTACTO --}}
    <section class="cm-bottom">
        <div class="cm-container cm-bottom__grid">

            <div class="cm-faq">
                <h2>Preguntas frecuentes</h2>

                <div class="cm-faq__list">
                    @foreach($preguntas as $pregunta)
                        <details class="cm-faq__item">
                            <summary>{{ $pregunta['titulo'] }}</summary>
                            <p>{{ $pregunta['respuesta'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>

            <aside
                class="cm-contact"
                id="contacto-marketing"
                aria-labelledby="cm-contact-title">

                <span class="cm-contact__icon">
                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <use href="#icon-chat"/>
                    </svg>
                </span>

                <p class="cm-eyebrow">HABLEMOS DE TU MARCA</p>

                <h2 id="cm-contact-title">
                    Cuéntanos qué quieres crear
                </h2>

                <p>
                    Háblanos de tu proyecto y de tus objetivos.
                    Prepararemos una propuesta según lo que necesitas.
                </p>

                <a
                    class="cm-button cm-button--white"
                    href="{{ $cotizar() }}"
                    @if($numero !== '')
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif>
                    Cotizar mi proyecto

                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <use href="#icon-arrow"/>
                    </svg>
                </a>

            </aside>

        </div>
    </section>

</div>
@endsection