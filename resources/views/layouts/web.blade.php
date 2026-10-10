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
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="description" content="@yield('descripcion', 'Soluciones tecnológicas y empresariales de CANVORA GROUP.')">
    <meta name="theme-color" content="#061737">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @php $cssVer = time(); @endphp
    <link rel="stylesheet" href="{{ asset('css/canvora-inflables.css') }}?v={{ $cssVer }}">
    <link rel="stylesheet" href="{{ asset('css/canvora-contabilidad.css') }}?v={{ $cssVer }}">
    <link rel="stylesheet" href="{{ asset('css/canvora-marketing.css') }}?v={{ $cssVer }}">
    <link rel="stylesheet" href="{{ asset('css/canvora-store.css') }}?v={{ $cssVer }}">
    <link rel="stylesheet" href="{{ asset('css/tech-v2.css') }}?v={{ $cssVer }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
    <script src="{{ asset('js/contacto.js') }}?v=3" defer></script>
    <script src="{{ asset('js/canvora-inflables.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}?v=laptop-12">
    <script src="{{ asset('js/inicio.js') }}?v=laptop-12" defer></script>
    <script src="{{ asset('js/tech-v2.js') }}?v=3d-1" defer></script>
    <!-- <link rel="stylesheet" href="{{ asset('css/canvora-3d.css') }}?v={{ $cssVer }}">
-->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}?v=header-compartido-9">
</head>
<body>
    {{-- Iconos compartidos --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" aria-hidden="true" style="position:absolute;overflow:hidden">
        <symbol id="icon-arrow" viewBox="0 0 24 24">
            <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
        </symbol>
        <symbol id="icon-laptop" viewBox="0 0 24 24">
            <path d="M5 4h14v12H5zM2 20h20l-3-4H5z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
        </symbol>
        <symbol id="icon-cart" viewBox="0 0 24 24">
            <path d="M2 3h3l3 13h11l3-9H6M9 20h.01M18 20h.01" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </symbol>
        <symbol id="icon-megaphone" viewBox="0 0 24 24">
            <path d="M3 10v4h5l11 5V5L8 10H3zM8 14l2 7h4l-3-6M22 9v6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
        </symbol>
        <symbol id="icon-pencil" viewBox="0 0 24 24">
            <path d="m15 4 5 5M4 20l5-1L21 7a2.1 2.1 0 0 0-4-4L5 15l-1 5z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
        </symbol>
        <symbol id="icon-document" viewBox="0 0 24 24">
            <path d="M6 3h8l4 4v14H6zM14 3v5h4M9 12h6M9 16h6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
        </symbol>
        <symbol id="icon-chat" viewBox="0 0 24 24">
            <path d="M21 11.5a9 9 0 0 1-13.3 7.9L3 21l1.6-4.7A9 9 0 1 1 21 11.5z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M8 8c0 4 4 8 8 8l1-3-3-1-1 1c-1.4-.6-2.4-1.6-3-3l1-1-1-3-2 2z" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
        </symbol>
    </svg>
@include('partials.header')
    <main>
        @yield('contenido')
    </main>
@include('partials.footer')
    {{-- BOTÓN FLOTANTE DE WHATSAPP DIRECTO --}}
    @if($whatsapp !== '')
    <aside class="whatsapp-floating" aria-label="Contacto directo por WhatsApp">
        <a href="https://wa.me/{{ $whatsapp }}?text={{ rawurlencode('Hola CANVORA GROUP, deseo comunicarme con un asesor.') }}" target="_blank" rel="noopener noreferrer" class="whatsapp-btn" id="whatsapp-floating-btn" aria-label="Chatear por WhatsApp">
            <span class="whatsapp-tooltip">¿Conversamos? Escríbenos</span>
            <span class="whatsapp-icon-wrap">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="#ffffff" aria-hidden="true">
                    <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2ZM12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.16 12.04 20.16C10.66 20.16 9.3 19.8 8.1 19.09L7.81 18.92L4.69 19.74L5.52 16.7L5.33 16.39C4.55 15.14 4.14 13.55 4.14 11.91C4.14 7.37 7.84 3.67 12.05 3.67ZM8.83 7.35C8.61 7.35 8.41 7.36 8.24 7.42C8.04 7.48 7.74 7.6 7.55 7.85C7.29 8.18 6.55 8.87 6.55 10.28C6.55 11.69 7.58 13.05 7.72 13.24C7.87 13.43 9.73 16.45 12.67 17.6C15.11 18.55 15.61 18.36 16.14 18.31C16.67 18.26 17.85 17.61 18.1 16.92C18.34 16.23 18.34 15.64 18.27 15.52C18.2 15.4 18.02 15.33 17.75 15.2C17.48 15.06 16.16 14.41 15.91 14.32C15.67 14.23 15.49 14.19 15.32 14.44C15.08 14.79 14.58 15.39 14.43 15.56C14.28 15.73 14.13 15.75 13.87 15.62C13.6 15.48 12.75 15.2 11.74 14.3C10.95 13.6 10.42 12.73 10.27 12.47C10.12 12.21 10.25 12.06 10.39 11.93C10.51 11.8 10.66 11.61 10.8 11.45C10.94 11.28 10.99 11.16 11.08 10.98C11.17 10.8 11.12 10.65 11.05 10.51C10.98 10.37 10.39 8.92 10.15 8.33C9.91 7.76 9.67 7.84 9.49 7.83C9.32 7.82 9.12 7.82 8.92 7.82L8.83 7.35Z" />
                </svg>
            </span>
            <span class="whatsapp-ping" aria-hidden="true"></span>
        </a>
    </aside>
    @endif
</body>
</html>
