@extends('layouts.web')

@section('title', 'Canvora Store | Equipos, tecnología y temporada')
@section('description', 'Balanzas, equipos para alimentos, equipamiento industrial y médico, tecnología y productos de temporada. Consulta y cotiza con Canvora Store.')

@section('contenido')

@php
    $carpetaImagenes = 'images/store/';
    $numeroWhatsapp = preg_replace('/\D/', '', (string) config('canvora.whatsapp', ''));
    $whatsapp = function ($mensaje) use ($numeroWhatsapp) {
        return $numeroWhatsapp !== ''
            ? 'https://wa.me/' . $numeroWhatsapp . '?text=' . rawurlencode($mensaje)
            : '#store-contacto';
    };

    // Cambia activa a false para ocultar la campaña manualmente.
    // Para otra temporada cambia las fechas, textos, imagen y mensaje.
    $campana = [
        'activa' => true,
        'inicio' => '2026-10-01',
        'fin' => '2027-01-06',
        'etiqueta' => 'Temporada especial',
        'titulo' => 'Navidad en Canvora',
        'descripcion' => 'Decoración, luces y detalles para esta temporada.',
        'imagen' => 'banner-navidad.png',
        'mensaje' => 'Hola, quiero consultar los productos de la temporada navideña de Canvora Store.',
    ];
    $ahora = now('America/Lima');
    $mostrarTemporada = $campana['activa'] && $ahora->between(
        \Carbon\Carbon::parse($campana['inicio'], 'America/Lima')->startOfDay(),
        \Carbon\Carbon::parse($campana['fin'], 'America/Lima')->endOfDay()
    );

    $categorias = [
        ['id' => 'pesaje', 'titulo' => 'Balanzas y pesaje', 'descripcion' => 'Precisión para tu negocio.', 'imagen' => 'balanza-plataforma.png', 'clase' => 'cs-category--large'],
        ['id' => 'alimentos', 'titulo' => 'Equipos para alimentos', 'descripcion' => 'Prepara, procesa y conserva.', 'imagen' => 'cortadora-carne.png', 'clase' => 'cs-category--food'],
        ['id' => 'industrial', 'titulo' => 'Equipos industriales', 'descripcion' => 'Soluciones para mayor productividad.', 'imagen' => 'cosedora-sacos.png', 'clase' => 'cs-category--industrial'],
        ['id' => 'medico', 'titulo' => 'Equipamiento médico', 'descripcion' => 'Calidad y precisión en cada atención.', 'imagen' => 'balanza-medica.png', 'clase' => 'cs-category--medical'],
        ['id' => 'tecnologia', 'titulo' => 'Tecnología y accesorios', 'descripcion' => 'Conecta y optimiza tu día a día.', 'imagen' => 'impresora-termica.png', 'clase' => 'cs-category--technology'],
        ['id' => 'temporada', 'titulo' => 'Temporada y novedades', 'descripcion' => 'Ideas y detalles para cada ocasión.', 'imagen' => $mostrarTemporada ? 'adorno-navideno.png' : 'impresora-termica.png', 'clase' => 'cs-category--season'],
    ];
    $productos = [
        ['categoria' => 'pesaje', 'etiqueta' => 'Balanzas y pesaje', 'titulo' => 'Balanza comercial digital', 'imagen' => 'balanza-comercial.png'],
        ['categoria' => 'pesaje', 'etiqueta' => 'Balanzas y pesaje', 'titulo' => 'Balanza de plataforma', 'imagen' => 'balanza-plataforma.png'],
        ['categoria' => 'industrial', 'etiqueta' => 'Equipos industriales', 'titulo' => 'Selladora térmica industrial', 'imagen' => 'selladora-industrial.png'],
        ['categoria' => 'alimentos', 'etiqueta' => 'Equipos para alimentos', 'titulo' => 'Cortadora de fiambres', 'imagen' => 'cortadora-carne.png'],
        ['categoria' => 'industrial', 'etiqueta' => 'Equipos industriales', 'titulo' => 'Cosedora de sacos', 'imagen' => 'cosedora-sacos.png'],
        ['categoria' => 'medico', 'etiqueta' => 'Equipamiento médico', 'titulo' => 'Balanza médica', 'imagen' => 'balanza-medica.png'],
        ['categoria' => 'tecnologia', 'etiqueta' => 'Tecnología y accesorios', 'titulo' => 'Impresora térmica', 'imagen' => 'impresora-termica.png'],
    ];
    if ($mostrarTemporada) {
        $productos[] = ['categoria' => 'temporada', 'etiqueta' => 'Temporada navideña', 'titulo' => 'Adornos navideños', 'imagen' => 'adorno-navideno.png'];
    }
    $preguntas = [
        ['titulo' => '¿Cómo puedo consultar un producto?', 'respuesta' => 'Pulsa Consultar en el producto que te interesa. Te atenderemos por WhatsApp para revisar sus características, disponibilidad y cotización.'],
        ['titulo' => '¿Los productos cuentan con garantía?', 'respuesta' => 'Consulta la garantía del equipo que te interesa. Sus condiciones y cobertura se indican en la cotización correspondiente.'],
        ['titulo' => '¿Realizan envíos a todo el Perú?', 'respuesta' => 'Consulta la cobertura para tu ciudad. Antes de confirmar tu pedido, coordinamos las opciones de entrega, el costo y el plazo estimado.'],
        ['titulo' => '¿Puedo solicitar una cotización para mi empresa?', 'respuesta' => 'Sí. Envíanos los productos, cantidades y datos de tu empresa para preparar una cotización según tu necesidad.'],
    ];
@endphp

<div class="cs-page">
    <div class="cs-shell">
        {{-- PORTADA --}}
        <section class="cs-hero" aria-labelledby="cs-hero-title">
            <img class="cs-hero__background" src="{{ asset($carpetaImagenes . 'hero-store.png') }}" alt="" fetchpriority="high">
            <div class="cs-hero__visual" aria-hidden="true">
                <div class="cs-hero__slice cs-hero__slice--first">
                    <img src="{{ asset($carpetaImagenes . 'balanza-comercial.png') }}" alt="">
                </div>
                <div class="cs-hero__slice cs-hero__slice--second">
                    <img src="{{ asset($carpetaImagenes . 'cortadora-carne.png') }}" alt="">
                </div>
                <div class="cs-hero__side">
                    <span>Equipos</span><span>Hogar</span><span>Negocio</span>
                    <span>Industria</span><span>Salud</span><span>Temporada</span>
                </div>
            </div>
            <div class="cs-hero__content">
                <p class="cs-eyebrow">Canvora Store</p>
                <h1 id="cs-hero-title">Soluciones para equipar.<span>Ideas para regalar.</span></h1>
                <p>Equipos y productos para tu negocio y hogar.</p>
                <a href="#store-categorias" class="cs-button">Encontrar mi producto <span aria-hidden="true">→</span></a>
            </div>
        </section>

        {{-- CATEGORÍAS --}}
        <section id="store-categorias" class="cs-section">
            <div class="cs-heading">
                <h2>Explora nuestras categorías</h2>
                <p>Equipos, tecnología y productos para diferentes necesidades.</p>
            </div>
            <div class="cs-categories">
                @foreach($categorias as $categoria)
                    <button type="button" class="cs-category {{ $categoria['clase'] }}"
                        data-cs-category="{{ $categoria['id'] }}" data-cs-title="{{ $categoria['titulo'] }}"
                        aria-haspopup="dialog" aria-controls="cs-catalog">
                        <span class="cs-category__content">
                            <strong>{{ $categoria['titulo'] }}</strong>
                            <span>{{ $categoria['descripcion'] }}</span>
                            <span class="cs-category__arrow" aria-hidden="true">→</span>
                        </span>
                        <img src="{{ asset($carpetaImagenes . $categoria['imagen']) }}" alt="" loading="lazy" decoding="async">
                    </button>
                @endforeach
            </div>
        </section>

        {{-- PRODUCTOS DESTACADOS --}}
        <section id="store-productos" class="cs-section">
            <div class="cs-heading">
                <h2>Productos destacados</h2>
                <button type="button" class="cs-text-link" data-cs-category="todos" data-cs-title="Todos los productos"
                    aria-haspopup="dialog" aria-controls="cs-catalog">Ver todo el catálogo →</button>
            </div>
            <div class="cs-products">
                @foreach(array_slice($productos, 0, 4) as $producto)
                    <article class="cs-product">
                        <p class="cs-product__label">{{ $producto['etiqueta'] }}</p>
                        <h3>{{ $producto['titulo'] }}</h3>
                        <img src="{{ asset($carpetaImagenes . $producto['imagen']) }}" alt="{{ $producto['titulo'] }}" loading="lazy" decoding="async">
                        <a href="{{ $whatsapp('Hola, me interesa consultar sobre: ' . $producto['titulo'] . '.') }}"
                            class="cs-button cs-button--outline" aria-label="Consultar {{ $producto['titulo'] }}"
                            @if($numeroWhatsapp !== '') target="_blank" rel="noopener noreferrer" @endif>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5Z"/></svg>
                            Consultar
                        </a>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- TEMPORADA CONFIGURABLE POR FECHAS --}}
        @if($mostrarTemporada)
            <section class="cs-season" aria-labelledby="cs-season-title">
                <img src="{{ asset($carpetaImagenes . $campana['imagen']) }}" alt="{{ $campana['titulo'] }}" loading="lazy" decoding="async">
                <div class="cs-season__content">
                    <p class="cs-eyebrow">{{ $campana['etiqueta'] }}</p>
                    <h2 id="cs-season-title">{{ $campana['titulo'] }}</h2>
                    <p>{{ $campana['descripcion'] }}</p>
                    <a href="{{ $whatsapp($campana['mensaje']) }}" class="cs-button cs-button--white"
                        @if($numeroWhatsapp !== '') target="_blank" rel="noopener noreferrer" @endif>Ver temporada →</a>
                </div>
            </section>
        @endif

        {{-- CÓMO COMPRAR --}}
        <section class="cs-section cs-buy">
            <div class="cs-buy__main">
                <h2>¿Cómo comprar en Canvora Store?</h2>
                <div class="cs-steps">
                    <article class="cs-step"><span class="cs-step__number">1</span><div><h3>Elige</h3><p>Explora nuestras categorías y encuentra el producto que necesitas.</p></div></article>
                    <article class="cs-step"><span class="cs-step__number">2</span><div><h3>Consulta</h3><p>Escríbenos por WhatsApp para conocer precio y disponibilidad.</p></div></article>
                    <article class="cs-step"><span class="cs-step__number">3</span><div><h3>Coordina tu pedido</h3><p>Te ayudamos a coordinar los detalles de tu compra y entrega.</p></div></article>
                </div>
            </div>
            <aside id="store-contacto" class="cs-contact">
                <h3>¿Tienes alguna consulta?</h3><p>Escríbenos por WhatsApp.</p>
                @if($numeroWhatsapp !== '')
                    <a href="{{ $whatsapp('Hola, necesito información sobre los productos de Canvora Store.') }}" class="cs-button cs-button--white" target="_blank" rel="noopener noreferrer">Contactar ahora →</a>
                @else
                    <p class="cs-contact__notice">Nuestro canal de consultas estará disponible pronto.</p>
                @endif
            </aside>
        </section>

        {{-- PREGUNTAS FRECUENTES --}}
        <section class="cs-section cs-faq">
            <div class="cs-heading"><h2>Preguntas frecuentes</h2><a href="#store-contacto" class="cs-text-link">Consultar →</a></div>
            <div class="cs-faq__grid">
                @foreach($preguntas as $pregunta)
                    <details><summary>{{ $pregunta['titulo'] }}</summary><p>{{ $pregunta['respuesta'] }}</p></details>
                @endforeach
            </div>
        </section>
    </div>

    {{-- CATÁLOGO COMPLETO --}}
    <dialog id="cs-catalog" class="cs-catalog" aria-labelledby="cs-catalog-title">
        <div class="cs-catalog__heading">
            <div><p class="cs-eyebrow">Canvora Store</p><h2 id="cs-catalog-title">Todos los productos</h2></div>
            <button type="button" class="cs-catalog__close" aria-label="Cerrar catálogo">×</button>
        </div>
        <div class="cs-catalog__grid">
            @foreach($productos as $producto)
                <article class="cs-product" data-cs-product="{{ $producto['categoria'] }}">
                    <p class="cs-product__label">{{ $producto['etiqueta'] }}</p><h3>{{ $producto['titulo'] }}</h3>
                    <img src="{{ asset($carpetaImagenes . $producto['imagen']) }}" alt="{{ $producto['titulo'] }}" loading="lazy">
                    <a href="{{ $whatsapp('Hola, me interesa consultar sobre: ' . $producto['titulo'] . '.') }}"
                        class="cs-button cs-button--outline" aria-label="Consultar {{ $producto['titulo'] }}"
                        @if($numeroWhatsapp !== '') target="_blank" rel="noopener noreferrer" @endif>Consultar →</a>
                </article>
            @endforeach
        </div>
        <div class="cs-catalog__empty" hidden>
            <p>Consulta las novedades disponibles para esta categoría.</p>
            <a href="{{ $whatsapp('Hola, quiero consultar las novedades de Canvora Store.') }}" class="cs-button"
                @if($numeroWhatsapp !== '') target="_blank" rel="noopener noreferrer" @endif>Consultar novedades →</a>
        </div>
    </dialog>
</div>

<script>
(() => {
    const page = document.querySelector('.cs-page');
    if (!page) return;
    const catalog = page.querySelector('#cs-catalog');
    const title = page.querySelector('#cs-catalog-title');
    const close = page.querySelector('.cs-catalog__close');
    const empty = page.querySelector('.cs-catalog__empty');
    const products = [...page.querySelectorAll('[data-cs-product]')];
    let trigger = null;
    let previousOverflow = '';
    page.querySelectorAll('[data-cs-category]').forEach(button => {
        button.addEventListener('click', () => {
            if (catalog.open) return;
            const category = button.dataset.csCategory;
            products.forEach(product => {
                product.hidden = category !== 'todos' && product.dataset.csProduct !== category;
            });
            empty.hidden = products.some(product => !product.hidden);
            title.textContent = button.dataset.csTitle;
            trigger = button;
            previousOverflow = document.body.style.overflow;
            catalog.showModal();
            document.body.style.overflow = 'hidden';
        });
    });
    close.addEventListener('click', () => catalog.close());
    catalog.addEventListener('close', () => {
        document.body.style.overflow = previousOverflow;
        trigger?.focus({ preventScroll: true });
    });
    catalog.addEventListener('click', event => {
        if (event.target !== catalog) return;
        const rect = catalog.getBoundingClientRect();
        if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) catalog.close();
    });
    catalog.querySelectorAll('a[href="#store-contacto"]').forEach(link => {
        link.addEventListener('click', () => catalog.close());
    });
})();
</script>
@endsection
