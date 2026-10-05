@php
$whatsapp = preg_replace('/\D/', '', config('canvora.whatsapp', ''));

$mensajeGeneral = 'Hola, quisiera información sobre CANVORA GROUP.';

$contactoUrl = $whatsapp !== ''
? 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode($mensajeGeneral)
: '#contacto';

$esInicio = request()->routeIs('inicio');
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('titulo', 'CANVORA GROUP')</title>

    <meta
        name="description"
        content="@yield('descripcion', 'Soluciones tecnológicas y empresariales de CANVORA GROUP.')">

    <meta name="theme-color" content="#061737">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="{{ asset('css/canvora.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/canvora-tech.css') }}">
    <link rel="stylesheet" href="{{ asset('css/canvora-inflables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/canvora-contabilidad.css') }}">
    <link rel="stylesheet" href="{{ asset('css/canvora-marketing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/canvora-store.css') }}">
</head>


<body>
    {{-- Iconos compartidos --}}
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="0"
        height="0"
        aria-hidden="true"
        style="position:absolute;overflow:hidden">

        <symbol id="icon-arrow" viewBox="0 0 24 24">
            <path
                d="M5 12h14M13 6l6 6-6 6"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>

        <symbol id="icon-laptop" viewBox="0 0 24 24">
            <path
                d="M5 4h14v12H5zM2 20h20l-3-4H5z"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>

        <symbol id="icon-cart" viewBox="0 0 24 24">
            <path
                d="M2 3h3l3 13h11l3-9H6M9 20h.01M18 20h.01"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>

        <symbol id="icon-megaphone" viewBox="0 0 24 24">
            <path
                d="M3 10v4h5l11 5V5L8 10H3zM8 14l2 7h4l-3-6M22 9v6"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>

        <symbol id="icon-pencil" viewBox="0 0 24 24">
            <path
                d="m15 4 5 5M4 20l5-1L21 7a2.1 2.1 0 0 0-4-4L5 15l-1 5z"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>

        <symbol id="icon-document" viewBox="0 0 24 24">
            <path
                d="M6 3h8l4 4v14H6zM14 3v5h4M9 12h6M9 16h6"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>

        <symbol id="icon-chat" viewBox="0 0 24 24">
            <path
                d="M21 11.5a9 9 0 0 1-13.3 7.9L3 21l1.6-4.7A9 9 0 1 1 21 11.5z"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round" />
            <path
                d="M8 8c0 4 4 8 8 8l1-3-3-1-1 1c-1.4-.6-2.4-1.6-3-3l1-1-1-3-2 2z"
                fill="none"
                stroke="currentColor"
                stroke-width="1.4"
                stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>
    </svg>

    <header class="site-header">
        <div class="container header-inner">
            <a
                class="brand"
                href="{{ route('inicio') }}"
                aria-label="CANVORA GROUP, inicio">

                <img
                    src="{{ asset('images/logo-canvora.png') }}"
                    alt="CANVORA GROUP"
                    fetchpriority="high">
            </a>

            <button
                class="menu-toggle"
                id="menu-toggle"
                type="button"
                aria-label="Abrir menú"
                aria-controls="navigation"
                aria-expanded="false">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <nav
                class="navigation"
                id="navigation"
                aria-label="Navegación principal">

                <a
                    class="nav-link {{ $esInicio ? 'active' : '' }}"
                    href="{{ route('inicio') }}"
                    @if($esInicio) aria-current="page" @endif>
                    Inicio
                </a>

                <a
                    class="nav-link"
                    href="{{ route('inicio') }}#soluciones">
                    Soluciones
                </a>

                @if(request()->routeIs('tecnologia'))
                <a
                    class="nav-link active"
                    href="{{ route('tecnologia') }}"
                    aria-current="page">
                    Canvora Tech
                </a>

                @elseif(request()->routeIs('inflables'))
                <a
                    class="nav-link active"
                    href="{{ route('inflables') }}"
                    aria-current="page">
                    Canvora Inflables
                </a>

                @elseif(request()->routeIs('contabilidad'))
                <a
                    class="nav-link active"
                    href="{{ route('contabilidad') }}"
                    aria-current="page">
                    Canvora Contabilidad
                </a>
                @elseif(request()->routeIs('marketing'))
                    <a
                        class="nav-link active"
                        href="{{ route('marketing') }}"
                        aria-current="page">
                        Canvora Marketing
                    </a>

                 @elseif(request()->routeIs('store'))
                    <a
                        class="nav-link active"
                        href="{{ route('store') }}"
                        aria-current="page">
                        Canvora Store
                    </a>
                @else
                
                <a
                    class="nav-link"
                    href="{{ route('inicio') }}#nosotros">
                    Nosotros
                </a>
                @endif

<a
    class="nav-link"
    href="{{ request()->routeIs('marketing')
        ? route('marketing') . '#contacto-marketing'
        : (request()->routeIs('contabilidad')
            ? route('contabilidad') . '#contacto-contabilidad'
            : (request()->routeIs('inflables')
                ? route('inflables') . '#contacto-inflables'
                : route('inicio') . '#contacto')) }}">
    Contacto
</a>

                <a
                    class="button"
                    href="{{ $contactoUrl }}"
                    @if($whatsapp !=='' )
                    target="_blank"
                    rel="noopener noreferrer"
                    @endif>
                    Cotizar

                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <use href="#icon-arrow" />
                    </svg>
                </a>

            </nav>
        </div>
    </header>

    <main>
        @yield('contenido')
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <a
                class="footer-brand"
                href="{{ route('inicio') }}"
                aria-label="CANVORA GROUP, inicio">

                <img
                    src="{{ asset('images/logo-canvora.png') }}"
                    alt="CANVORA GROUP"
                    loading="lazy">
            </a>

            <nav
                class="footer-links"
                aria-label="Navegación del pie de página">

                <a href="{{ route('inicio') }}">Inicio</a>
                <a href="{{ route('inicio') }}#soluciones">Soluciones</a>
                <a href="{{ route('tecnologia') }}">Canvora Tech</a>
                <a href="#contacto">Contacto</a>
            </nav>

            <p class="copyright">
                © {{ date('Y') }} CANVORA GROUP.<br>
                Todos los derechos reservados.
            </p>
        </div>
    </footer>

    <script>
        const toggle = document.getElementById('menu-toggle');
        const navigation = document.getElementById('navigation');

        function closeMenu() {
            navigation.classList.remove('open');
            document.body.classList.remove('menu-open');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.setAttribute('aria-label', 'Abrir menú');
        }

        toggle.addEventListener('click', function() {
            const isOpen = navigation.classList.toggle('open');

            document.body.classList.toggle('menu-open', isOpen);
            toggle.setAttribute('aria-expanded', String(isOpen));
            toggle.setAttribute(
                'aria-label',
                isOpen ? 'Cerrar menú' : 'Abrir menú'
            );
        });

        navigation.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', closeMenu);
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const wasOpen = navigation.classList.contains('open');

                closeMenu();

                if (wasOpen) toggle.focus();
            }
        });

        window.matchMedia('(min-width: 851px)')
            .addEventListener('change', function(event) {
                if (event.matches) closeMenu();
            });
    </script>
    <script src="{{ asset('js/canvora-inflables.js') }}" defer></script>
</body>

</html>