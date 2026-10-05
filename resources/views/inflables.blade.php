@extends('layouts.web')

@section('contenido')
@php
    $numero = preg_replace('/\D/', '', (string) config('canvora.whatsapp'));

    $cotizar = function ($producto = '') use ($numero) {
        if (!$numero) {
            return '#contacto-inflables';
        }

        $mensaje = $producto
            ? "Hola, Canvora. Quisiera información y una cotización de: {$producto}."
            : 'Hola, Canvora. Quisiera cotizar un inflable para mi evento.';

        return 'https://wa.me/' . $numero . '?text=' . rawurlencode($mensaje);
    };

    $publicitarios = [
        [
            'nombre' => 'Arcos inflables',
            'descripcion' => 'Una entrada que destaca en eventos y activaciones.',
            'imagen' => 'arco-publicitario.jpg',
        ],
        [
            'nombre' => 'Globos publicitarios',
            'descripcion' => 'Dale presencia a tu marca con un formato de gran tamaño.',
            'imagen' => 'globo-pera.jpg',
        ],
        [
            'nombre' => 'Carpas inflables',
            'descripcion' => 'Espacios llamativos para exhibiciones y campañas.',
            'imagen' => 'carpa-verde.jpg',
        ],
        [
            'nombre' => 'Tótems luminosos',
            'descripcion' => 'Una propuesta visual para eventos y ambientaciones.',
            'imagen' => 'totems-luminosos.jpg',
        ],
        [
            'nombre' => 'Réplicas de productos',
            'descripcion' => 'Convierte la forma de tu producto en una gran idea.',
            'imagen' => 'replica-envase.jpg',
        ],
        [
            'nombre' => 'Globos mochila',
            'descripcion' => 'Una opción para acompañar activaciones de marca.',
            'imagen' => 'globo-mochila.jpg',
        ],
        [
            'nombre' => 'Pelotas gigantes',
            'descripcion' => 'Formatos para animar eventos y dar visibilidad.',
            'imagen' => 'pelotas-gigantes.jpg',
        ],
        [
            'nombre' => 'Muñecos publicitarios',
            'descripcion' => 'Una figura llamativa para destacar tu negocio.',
            'imagen' => 'muneco-publicitario.jpg',
        ],
    ];

    $infantiles = [
        [
            'nombre' => 'Castillos inflables',
            'descripcion' => 'Ideas para cumpleaños y celebraciones infantiles.',
            'imagen' => 'castillo-infantil.png',
        ],
        [
            'nombre' => 'Toboganes inflables',
            'descripcion' => 'Consulta modelos, medidas y disponibilidad para tu evento.',
            'imagen' => 'tobogan-infantil.png',
        ],
    ];

    $preguntas = [
        [
            'titulo' => '¿Qué tipos de inflables puedo consultar?',
            'respuesta' => 'Puedes consultar inflables publicitarios e infantiles. Cuéntanos qué necesitas y te confirmaremos los modelos, medidas y disponibilidad.',
        ],
        [
            'titulo' => '¿Se pueden personalizar?',
            'respuesta' => 'En los modelos publicitarios podemos evaluar colores, dimensiones y ubicación del logo según el producto. La propuesta se confirma antes de contratar.',
        ],
        [
            'titulo' => '¿Puedo consultar por compra o alquiler?',
            'respuesta' => 'Sí. Indica cuál de las dos opciones buscas y te confirmaremos qué modalidad está disponible para el modelo elegido.',
        ],
        [
            'titulo' => '¿Qué información necesito para cotizar?',
            'respuesta' => 'Envíanos el modelo de interés, ciudad, fecha del evento y medidas aproximadas del espacio. Para publicidad, puedes adjuntar tu logo o una referencia.',
        ],
    ];
@endphp

<main class="ci-page">
    {{-- PORTADA --}}
    <section class="ci-hero">
        <div class="ci-container ci-hero__grid">
            <div class="ci-hero__content">
                <p class="ci-eyebrow">CANVORA INFLABLES</p>

                <h1>
                    Grandes ideas.
                    <span>Grandes momentos.</span>
                </h1>

                <p class="ci-hero__description">
                    Inflables publicitarios e infantiles para
                    marcas y celebraciones que dejan huella.
                </p>

                <a class="ci-button" href="{{ $cotizar() }}">
                    Consultar disponibilidad
                    <span aria-hidden="true">→</span>
                </a>

                <div class="ci-benefits">
                    <div>
                        <span aria-hidden="true">✦</span>
                        <p>Impacto visual</p>
                    </div>

                    <div>
                        <span aria-hidden="true">◇</span>
                        <p>Versatilidad</p>
                    </div>

                    <div>
                        <span aria-hidden="true">♡</span>
                        <p>Momentos especiales</p>
                    </div>

                    <div>
                        <span aria-hidden="true">☆</span>
                        <p>Ideas a tu medida</p>
                    </div>
                </div>
            </div>

            <div class="ci-hero__collage">
                <figure class="ci-hero__arch">
                    <img
                        src="{{ asset('images/inflables/arco-publicitario.jpg') }}"
                        alt="Arco publicitario instalado en un espacio exterior"
                        fetchpriority="high"
                        width="1632"
                        height="754"
                    >
                </figure>

                <figure class="ci-hero__globe">
                    <img
                        src="{{ asset('images/inflables/globo-pera.jpg') }}"
                        alt="Globo publicitario de gran tamaño"
                        width="1223"
                        height="1223"
                    >
                </figure>

                <figure class="ci-hero__castle">
                    <img
                        src="{{ asset('images/inflables/castillo-infantil.png') }}"
                        alt="Diseño referencial de castillo inflable infantil"
                        width="1448"
                        height="1086"
                    >
                    <figcaption>Imagen referencial</figcaption>
                </figure>
            </div>
        </div>
    </section>

    {{-- LAS DOS LÍNEAS --}}
    <section class="ci-lines" aria-label="Líneas de inflables">
        <div class="ci-container ci-lines__grid">
            <article class="ci-line ci-line--business" id="publicitarios">
                <img
                    src="{{ asset('images/inflables/carpa-verde.jpg') }}"
                    alt="Carpa inflable publicitaria"
                    loading="lazy"
                    width="1856"
                    height="836"
                >

                <div class="ci-line__content">
                    <p class="ci-eyebrow">INFLABLES PUBLICITARIOS</p>
                    <h2>Haz crecer <span>tu marca.</span></h2>

                    <p>
                        Formatos de gran impacto para
                        eventos, campañas y activaciones.
                    </p>

                    <button
                        class="ci-button ci-button--white"
                        type="button"
                        data-ci-category="publicitarios"
                        data-ci-jump
                    >
                        Ver modelos <span aria-hidden="true">→</span>
                    </button>
                </div>
            </article>

            <article class="ci-line ci-line--children" id="infantiles">
                <img
                    src="{{ asset('images/inflables/tobogan-infantil.png') }}"
                    alt="Diseño referencial de tobogán inflable"
                    loading="lazy"
                    width="1448"
                    height="1086"
                >

                <div class="ci-line__content">
                    <p class="ci-eyebrow">INFLABLES INFANTILES</p>
                    <h2>Haz especial <span>su celebración.</span></h2>

                    <p>
                        Castillos y toboganes para celebrar.
                        Consulta modelos y disponibilidad.
                    </p>

                    <button
                        class="ci-button ci-button--white"
                        type="button"
                        data-ci-category="infantiles"
                        data-ci-jump
                    >
                        Ver modelos <span aria-hidden="true">→</span>
                    </button>
                </div>

                <span class="ci-reference">Imagen referencial</span>
            </article>
        </div>
    </section>

    {{-- CATÁLOGO --}}
    <section class="ci-catalog" id="modelos-inflables">
        <div class="ci-container">
            <div class="ci-heading">
                <p class="ci-eyebrow">ELIGE TU EXPERIENCIA</p>
                <h2>Nuestras líneas de inflables</h2>

                <div class="ci-tabs" role="group" aria-label="Filtrar modelos">
                    <button
                        type="button"
                        class="is-active"
                        data-ci-category="publicitarios"
                        aria-pressed="true"
                    >
                        Publicitarios
                    </button>

                    <button
                        type="button"
                        data-ci-category="infantiles"
                        aria-pressed="false"
                    >
                        Infantiles
                    </button>
                </div>
            </div>

            <div class="ci-carousel">
                <button
                    class="ci-arrow ci-arrow--previous"
                    id="ci-previous"
                    type="button"
                    aria-label="Ver modelos anteriores"
                >
                    ‹
                </button>

                <div
                    class="ci-track"
                    id="ci-track"
                    tabindex="0"
                    aria-label="Modelos de inflables"
                    aria-roledescription="carrusel"
                >
                    @foreach ($publicitarios as $producto)
                        <article
                            class="ci-card"
                            data-ci-group="publicitarios"
                        >
                            <div class="ci-card__image">
                                <img
                                    src="{{ asset('images/inflables/' . $producto['imagen']) }}"
                                    alt="{{ $producto['nombre'] }} del catálogo de referencia"
                                    loading="lazy"
                                >
                            </div>

                            <div class="ci-card__body">
                                <h3>{{ $producto['nombre'] }}</h3>
                                <p>{{ $producto['descripcion'] }}</p>

                                <a href="{{ $cotizar($producto['nombre']) }}">
                                    Consultar modelo
                                    <span aria-hidden="true">→</span>
                                </a>

                                <small>Referencia del catálogo</small>
                            </div>
                        </article>
                    @endforeach

                    @foreach ($infantiles as $producto)
                        <article
                            class="ci-card"
                            data-ci-group="infantiles"
                            hidden
                        >
                            <div class="ci-card__image">
                                <img
                                    src="{{ asset('images/inflables/' . $producto['imagen']) }}"
                                    alt="Imagen referencial de {{ mb_strtolower($producto['nombre']) }}"
                                    loading="lazy"
                                >

                                <span class="ci-reference">
                                    Imagen referencial
                                </span>
                            </div>

                            <div class="ci-card__body">
                                <h3>{{ $producto['nombre'] }}</h3>
                                <p>{{ $producto['descripcion'] }}</p>

                                <a href="{{ $cotizar($producto['nombre']) }}">
                                    Consultar disponibilidad
                                    <span aria-hidden="true">→</span>
                                </a>

                                <small>Modelo ilustrativo</small>
                            </div>
                        </article>
                    @endforeach
                </div>

                <button
                    class="ci-arrow ci-arrow--next"
                    id="ci-next"
                    type="button"
                    aria-label="Ver siguientes modelos"
                >
                    ›
                </button>
            </div>

            <div
                class="ci-dots"
                id="ci-dots"
                role="group"
                aria-label="Posiciones del catálogo"
            ></div>
        </div>
    </section>

    {{-- BANNER INFANTIL --}}
    <section class="ci-family">
        <div class="ci-container">
            <article class="ci-family__panel">
                <img
                    src="{{ asset('images/inflables/celebracion-infantil.png') }}"
                    alt="Escena referencial de celebración con inflables infantiles"
                    loading="lazy"
                    width="1672"
                    height="941"
                >

                <div class="ci-family__content">
                    <p class="ci-eyebrow">INFLABLES INFANTILES</p>

                    <h2>
                        Diversión para
                        sus mejores
                        <span>recuerdos.</span>
                    </h2>

                    <p>
                        Cuéntanos la fecha, el lugar y el espacio
                        disponible para encontrar una propuesta
                        para tu celebración.
                    </p>

                    <a class="ci-button" href="{{ $cotizar('Inflables infantiles') }}">
                        Consultar disponibilidad
                        <span aria-hidden="true">→</span>
                    </a>
                </div>

                <span class="ci-reference">Imagen referencial</span>
            </article>
        </div>
    </section>

    {{-- PERSONALIZACIÓN --}}
    <section class="ci-personalize">
        <div class="ci-container ci-info-grid">
            <div>
                <p class="ci-eyebrow">PERSONALIZA TU INFLABLE</p>
                <h2>A tu medida</h2>
                <p>Evaluamos tu idea y las opciones para cada modelo.</p>
            </div>

            <article class="ci-feature">
                <span class="ci-feature__icon" aria-hidden="true">↗</span>
                <div>
                    <h3>Tamaño</h3>
                    <p>Dimensiones según el modelo y el espacio.</p>
                </div>
            </article>

            <article class="ci-feature">
                <span class="ci-feature__icon" aria-hidden="true">◉</span>
                <div>
                    <h3>Color</h3>
                    <p>Opciones que acompañan la identidad de tu marca.</p>
                </div>
            </article>

            <article class="ci-feature">
                <span class="ci-feature__icon" aria-hidden="true">✎</span>
                <div>
                    <h3>Diseño</h3>
                    <p>Logo, mensajes y propuesta visual para publicidad.</p>
                </div>
            </article>
        </div>
    </section>

    {{-- PROCESO --}}
    <section class="ci-process">
        <div class="ci-container ci-process__grid">
            <div>
                <p class="ci-eyebrow">UN PROCESO SIMPLE</p>
                <h2>De la idea al evento</h2>
            </div>

            <ol class="ci-steps">
                <li>
                    <span>1</span>
                    <h3>Idea</h3>
                    <p>Cuéntanos qué necesitas y para cuándo.</p>
                </li>

                <li>
                    <span>2</span>
                    <h3>Propuesta</h3>
                    <p>Revisamos modelos y opciones para tu proyecto.</p>
                </li>

                <li>
                    <span>3</span>
                    <h3>Cotización</h3>
                    <p>Definimos condiciones, alcance y presupuesto.</p>
                </li>

                <li>
                    <span>4</span>
                    <h3>Coordinación</h3>
                    <p>Acordamos los detalles de entrega o del evento.</p>
                </li>
            </ol>
        </div>
    </section>

    {{-- PREGUNTAS --}}
    <section class="ci-faq">
        <div class="ci-container ci-faq__grid">
            <div>
                <p class="ci-eyebrow">PREGUNTAS FRECUENTES</p>
                <h2>¿Tienes dudas?</h2>
                <p>Te ayudamos a definir la mejor opción para tu idea.</p>
            </div>

            <div class="ci-faq__list">
                @foreach ($preguntas as $pregunta)
                    <details>
                        <summary>{{ $pregunta['titulo'] }}</summary>
                        <p>{{ $pregunta['respuesta'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CONTACTO --}}
    <section class="ci-contact" id="contacto-inflables">
        <div class="ci-container ci-contact__grid">
            <div>
                <p class="ci-eyebrow">CONVERSEMOS</p>
                <h2>Hagamos realidad tu próximo evento.</h2>
                <p>
                    Cuéntanos tu idea, ciudad y fecha.
                    Te ayudaremos a definir tu cotización.
                </p>
            </div>

            @if ($numero)
                <a class="ci-button ci-button--white" href="{{ $cotizar() }}">
                    Cotizar por WhatsApp
                    <span aria-hidden="true">→</span>
                </a>
            @endif
        </div>
    </section>
</main>
@endsection