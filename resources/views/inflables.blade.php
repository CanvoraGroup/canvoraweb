@extends('layouts.web')

@section('contenido')
@php
$numero = preg_replace('/\D/', '', config('canvora.whatsapp', ''));
$cotizar = fn($producto) => $numero !== '' ? 'https://wa.me/'.$numero.'?text='.rawurlencode('Hola, quisiera cotizar '.$producto.' con CANVORA INFLABLES.') : '#contacto-inflables';
$productos = [
['nombre' => 'Arco cilíndrico', 'categoria' => 'arcos', 'imagen' => 'arco-cilindrico.jpg', 'descripcion' => 'Presencia visual para entradas y activaciones.'],
['nombre' => 'Arco de esquinas redondas', 'categoria' => 'arcos', 'imagen' => 'arco-esquinas-redondas.jpg', 'descripcion' => 'Un acceso que destaca tu marca.'],
['nombre' => 'Arco publicitario', 'categoria' => 'arcos', 'imagen' => 'arco-publicitario.jpg', 'descripcion' => 'Dale protagonismo a tu evento.'],
['nombre' => 'Carpa blanca', 'categoria' => 'carpas', 'imagen' => 'carpa-blanca.jpg', 'descripcion' => 'Un espacio para presentar tu marca.'],
['nombre' => 'Carpa verde', 'categoria' => 'carpas', 'imagen' => 'carpa-verde.jpg', 'descripcion' => 'Una presencia diferente para tus activaciones.'],
['nombre' => 'Globo pera', 'categoria' => 'globos', 'imagen' => 'globo-pera.jpg', 'descripcion' => 'Tu mensaje en gran formato.'],
['nombre' => 'Globo verde', 'categoria' => 'globos', 'imagen' => 'globo-verde.jpg', 'descripcion' => 'Haz que tu marca destaque.'],
['nombre' => 'Globo mochila', 'categoria' => 'globos', 'imagen' => 'globo-mochila.jpg', 'descripcion' => 'Lleva tu publicidad donde está tu público.'],
['nombre' => 'Cilindro mochila', 'categoria' => 'globos', 'imagen' => 'cilindro-mochila.jpg', 'descripcion' => 'Publicidad móvil para tus campañas.'],
['nombre' => 'Muñeco publicitario', 'categoria' => 'personajes', 'imagen' => 'muneco-publicitario.jpg', 'descripcion' => 'Movimiento que atrae las miradas.'],
['nombre' => 'Personaje inflable', 'categoria' => 'personajes', 'imagen' => 'personaje-inflable.jpg', 'descripcion' => 'Dale vida a tu personaje o mascota.'],
['nombre' => 'Réplica de botella', 'categoria' => 'replicas', 'imagen' => 'replica-botella.jpg', 'descripcion' => 'Tu producto en tamaño gigante.'],
['nombre' => 'Réplica de envase', 'categoria' => 'replicas', 'imagen' => 'replica-envase.jpg', 'descripcion' => 'Convierte tu empaque en protagonista.'],
['nombre' => 'Pelotas gigantes', 'categoria' => 'replicas', 'imagen' => 'pelotas-gigantes.jpg', 'descripcion' => 'Una forma diferente de mostrar tu marca.'],
['nombre' => 'Pack arco y tótems', 'categoria' => 'totems', 'imagen' => 'pack-arco-totems.jpg', 'descripcion' => 'Un conjunto visual para tu evento.'],
['nombre' => 'Tótems luminosos', 'categoria' => 'totems', 'imagen' => 'totems-luminosos.jpg', 'descripcion' => 'Tu marca también destaca de noche.'],
['nombre' => 'Castillo infantil', 'categoria' => 'infantiles', 'imagen' => 'castillo-infantil.png', 'descripcion' => 'Color y diversión para las celebraciones.'],
['nombre' => 'Celebración infantil', 'categoria' => 'infantiles', 'imagen' => 'celebracion-infantil.png', 'descripcion' => 'Un espacio para compartir y jugar.'],
['nombre' => 'Tobogán infantil', 'categoria' => 'infantiles', 'imagen' => 'tobogan-infantil.png', 'descripcion' => 'Diversión a lo grande.'],
];
$escenarios = [
['titulo' => 'Publicidad que destaca', 'categoria' => 'arcos', 'indices' => [11, 0, 6]],
['titulo' => 'Activa tu marca', 'categoria' => 'globos', 'indices' => [8, 7, 10]],
['titulo' => 'Diversión a lo grande', 'categoria' => 'infantiles', 'indices' => [16, 18, 17]],
];
$categorias = ['todos' => 'Todos', 'arcos' => 'Arcos', 'carpas' => 'Carpas', 'globos' => 'Globos', 'replicas' => 'Réplicas', 'totems' => 'Tótems', 'personajes' => 'Personajes', 'infantiles' => 'Infantiles'];
@endphp

<div id="ci-inflables">
    <section class="ci-hero" aria-labelledby="ci-title">
        <div class="ci-container ci-hero-grid">
            <div class="ci-hero-copy">
                <span class="ci-eyebrow">CANVORA INFLABLES</span>
                <h1 id="ci-title">Inflables que <span>se roban las miradas.</span></h1>
                <p>Dale vida a tus eventos y activa tu marca con inflables publicitarios y recreativos. Venta y alquiler para tu próxima idea.</p>
                <div class="ci-actions">
                    <a class="ci-button ci-primary" href="{{ $cotizar('un inflable') }}">Cotizar mi proyecto <span aria-hidden="true">→</span></a>
                    <a class="ci-button ci-secondary" href="#catalogo-inflables">Ver catálogo</a>
                </div>
                <div class="ci-hero-notes">
                    <span>Para empresas y eventos</span>
                    <span>Publicidad en gran formato</span>
                    <span>Inflables recreativos</span>
                </div>
            </div>
            <div class="ci-showcase" aria-label="Productos destacados">
                <div class="ci-stage" data-ci-stage>
                    <div class="ci-stage-glow"></div>
                    @foreach($escenarios as $escenario)
                    <div class="ci-scene {{ $loop->first ? 'is-active' : '' }}" data-ci-scene aria-hidden="{{ $loop->first ? 'false' : 'true' }}">
                        @foreach($escenario['indices'] as $indice)
                        <figure class="ci-display ci-display-{{ $loop->iteration }}">
                            <img src="{{ asset('images/inflables/'.$productos[$indice]['imagen']) }}" alt="{{ $productos[$indice]['nombre'] }}" width="600" height="700" decoding="async" @if($loop->parent->first) fetchpriority="high" @else loading="lazy" @endif>
                            <figcaption>{{ $productos[$indice]['nombre'] }}</figcaption>
                        </figure>
                        @endforeach
                    </div>
                    @endforeach
                    <div class="ci-podium" aria-hidden="true"></div>
                </div>
                <div class="ci-showcase-controls">
                    <button class="ci-arrow" type="button" data-ci-prev aria-label="Mostrar productos anteriores">‹</button>
                    <div class="ci-scene-tabs" aria-label="Elegir grupo de productos">
                        @foreach($escenarios as $escenario)
                        <button class="{{ $loop->first ? 'is-active' : '' }}" type="button" data-ci-slide="{{ $loop->index }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}">{{ $categorias[$escenario['categoria']] }}</button>
                        @endforeach
                    </div>
                    <button class="ci-arrow" type="button" data-ci-next aria-label="Mostrar siguientes productos">›</button>
                </div>
                <div class="ci-showcase-caption">
                    <span data-ci-caption>{{ $escenarios[0]['titulo'] }}</span>
                    <button type="button" data-ci-pause aria-label="Pausar cambio automático" aria-pressed="false">Pausar</button>
                </div>
            </div>
        </div>
    </section>

<section class="ci-section" id="catalogo-inflables" aria-labelledby="ci-catalog-title">
    <div class="ci-container">
        <div class="ci-heading">
            <div><span class="ci-eyebrow">NUESTRO CATÁLOGO</span><h2 id="ci-catalog-title">Encuentra tu próximo <span>inflable.</span></h2></div>
            <p>Explora por categoría y descubre una opción para tu marca o evento.</p>
        </div>
        <div class="ci-filters" role="group" aria-label="Categorías del catálogo">
            @foreach($categorias as $clave => $nombre)
                <button class="{{ $loop->first ? 'is-active' : '' }}" type="button" data-ci-filter="{{ $clave }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}">{{ $nombre }}</button>
            @endforeach
        </div>
        <div class="cic-catalog" data-cic-catalog role="region" aria-roledescription="carrusel" aria-label="Catálogo de inflables">
            <div class="cic-stage" data-cic-stage>
                @foreach($productos as $producto)
                    <article class="cic-card {{ $loop->first ? 'is-current' : '' }}" data-cic-card data-category="{{ $producto['categoria'] }}" aria-hidden="{{ $loop->first ? 'false' : 'true' }}" @if(!$loop->first) inert @endif>
                        <div class="cic-photo">
                            <img src="{{ asset('images/inflables/'.$producto['imagen']) }}" alt="{{ $producto['nombre'] }}" width="900" height="700" loading="lazy" decoding="async">
                        </div>
                        <div class="cic-info">
                            <span class="cic-category">{{ $categorias[$producto['categoria']] }}</span>
                            <h3>{{ $producto['nombre'] }}</h3>
                            <p>{{ $producto['descripcion'] }}</p>
                            <span class="cic-service">Consulta opciones de venta y alquiler.</span>
                            <a class="ci-button ci-primary" href="{{ $cotizar($producto['nombre']) }}">Cotizar este inflable <span aria-hidden="true">↗</span></a>
                            <a class="cic-original" href="{{ asset('images/inflables/'.$producto['imagen']) }}" target="_blank" rel="noopener noreferrer">Ver fotografía completa ↗</a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="cic-controls">
                <button class="cic-arrow" type="button" data-cic-prev aria-label="Producto anterior">←</button>
                <div class="cic-counter"><strong data-cic-position>01</strong><span>/</span><span data-cic-total>{{ count($productos) }}</span></div>
                <button class="cic-arrow" type="button" data-cic-next aria-label="Producto siguiente">→</button>
                <button class="cic-pause" type="button" data-cic-pause aria-pressed="false">Pausar</button>
            </div>
            <p class="cic-hint">Elige una categoría o usa las flechas para explorar.</p>
            <span class="cic-sr" data-cic-announcement aria-live="polite" aria-atomic="true"></span>
        </div>
    </div>
</section>

    <section class="ci-section ci-night-section" aria-labelledby="ci-night-title">
        <div class="ci-container">
            <div class="ci-night">
                <div class="ci-night-copy">
                    <span class="ci-eyebrow">PRESENCIA QUE DESTACA</span>
                    <h2 id="ci-night-title">Impacto de día.<br><span>Presencia de noche.</span></h2>
                    <p>Los tótems luminosos aportan una presencia diferente a tus eventos y activaciones nocturnas.</p>
                    <a class="ci-button ci-primary" href="{{ $cotizar('tótems luminosos') }}">Cotizar tótems luminosos <span aria-hidden="true">→</span></a>
                </div>
                <img src="{{ asset('images/inflables/totems-luminosos.jpg') }}" alt="Tótems inflables azules iluminados durante la noche" width="900" height="700" loading="lazy">
            </div>
        </div>
    </section>

    <section class="ci-section ci-events-section" aria-labelledby="ci-events-title">
        <div class="ci-container">
            <div class="ci-heading">
                <div><span class="ci-eyebrow">PARA CADA OCASIÓN</span>
                    <h2 id="ci-events-title">Elige según <span>tu evento.</span></h2>
                </div>
                <p>Desde una activación de marca hasta una celebración infantil.</p>
            </div>
            <div class="ci-events-grid">
                <a class="ci-event" href="#catalogo-inflables" data-ci-event-filter="arcos">
                    <img src="{{ asset('images/inflables/arco-cilindrico.jpg') }}" alt="Arco inflable para eventos y activaciones publicitarias" width="900" height="650" loading="lazy">
                    <div>
                        <h3>Eventos corporativos</h3>
                        <p>Ferias, campañas y activaciones de marca.</p><span aria-hidden="true">↗</span>
                    </div>
                </a>
                <a class="ci-event" href="#catalogo-inflables" data-ci-event-filter="infantiles">
                    <img src="{{ asset('images/inflables/celebracion-infantil.png') }}" alt="Niños disfrutando de un castillo inflable con tobogán" width="900" height="650" loading="lazy">
                    <div>
                        <h3>Celebraciones infantiles</h3>
                        <p>Castillos y toboganes para compartir y jugar.</p><span aria-hidden="true">↗</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="ci-section ci-process-section" aria-labelledby="ci-process-title">
        <div class="ci-container">
            <div class="ci-heading">
                <div><span class="ci-eyebrow">EMPECEMOS CON TU IDEA</span>
                    <h2 id="ci-process-title">Del concepto <span>al inflable.</span></h2>
                </div>
                <p>Cuéntanos qué necesitas y revisamos las opciones para tu proyecto.</p>
            </div>
            <div class="ci-process-grid">
                <article><span class="ci-step">01</span>
                    <h3>Cuéntanos tu idea</h3>
                    <p>Indícanos el producto, el tipo de evento y la fecha que tienes en mente.</p>
                </article>
                <article><span class="ci-step">02</span>
                    <h3>Revisamos tu proyecto</h3>
                    <p>Conversamos sobre el diseño, las medidas y las opciones de personalización.</p>
                </article>
                <article><span class="ci-step">03</span>
                    <h3>Recibe tu cotización</h3>
                    <p>Te presentamos una propuesta según las características de tu solicitud.</p>
                </article>
            </div>
        </div>
    </section>



    <section class="ci-section ci-contact-section" id="contacto-inflables" aria-labelledby="ci-contact-title">
        <div class="ci-container">
            <div class="ci-contact">
                <div><span class="ci-eyebrow">HABLEMOS DE TU PROYECTO</span>
                    <h2 id="ci-contact-title">Cuéntanos qué tienes <span>en mente.</span></h2>
                    <p>Tu próxima campaña o celebración empieza con una idea.</p>
                </div>
                @if($numero !== '')
                <a class="ci-button ci-white" href="{{ $cotizar('un inflable para mi proyecto') }}">Cotizar por WhatsApp <span aria-hidden="true">↗</span></a>
                @else
                <p class="ci-contact-missing">Próximamente habilitaremos nuestro contacto por WhatsApp.</p>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection