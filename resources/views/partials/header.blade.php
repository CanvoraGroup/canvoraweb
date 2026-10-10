@php
    $headerTelefono = preg_replace(
        '/\D/',
        '',
        (string) config('canvora.whatsapp', '')
    );
    $headerMensaje = 'Hola, quisiera información sobre CANVORA GROUP.';
    $headerContactoUrl = $headerTelefono !== ''
        ? 'https://wa.me/' . $headerTelefono . '?text=' . rawurlencode($headerMensaje)
        : route('inicio') . '#contacto';
    $headerEsInicio = request()->routeIs('inicio');
@endphp
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('inicio') }}" aria-label="CANVORA GROUP, inicio"><img src="{{ asset('images/logo-canvora.png') }}" alt="CANVORA GROUP" fetchpriority="high"></a>
            <button class="menu-toggle" id="menu-toggle" type="button" aria-label="Abrir menú" aria-controls="navigation" aria-expanded="false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <nav class="navigation" id="navigation" aria-label="Navegación principal">
                <a class="nav-link {{ $headerEsInicio ? 'active' : '' }}" href="{{ route('inicio') }}" @if($headerEsInicio) aria-current="page" @endif>Inicio</a>
                <a class="nav-link" href="{{ route('inicio') }}#soluciones">Soluciones</a>
                {{-- Menú desplegable de Nosotros y Divisiones Canvora --}}
                @php
                $headerEsDivision = request()->routeIs('tecnologia') || request()->routeIs('store') || request()->routeIs('inflables') || request()->routeIs('marketing') || request()->routeIs('contabilidad');
                @endphp
                <div class="nav-dropdown" id="nav-dropdown-nosotros">
                    <button class="nav-link nav-dropdown-btn {{ $headerEsDivision ? 'active' : '' }}" type="button" aria-expanded="false" aria-haspopup="true" aria-controls="dropdown-menu-nosotros">
                        <span>Nosotros</span>
                        <svg class="dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:12px;height:12px;display:inline-block;vertical-align:middle;">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="dropdown-menu" id="dropdown-menu-nosotros" role="menu">
                        <a class="dropdown-item" href="{{ route('inicio') }}#nosotros" role="menuitem">
                            <div class="dropdown-item-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width:18px;height:18px;min-width:18px;max-width:18px;display:block;">
                                    <path d="M3 21h18M9 8h1M9 12h1M9 16h1M14 8h1M14 12h1M14 16h1M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16" />
                                </svg>
                            </div>
                            <div class="dropdown-item-text">
                                <span class="dropdown-item-title">Sobre Nosotros</span>
                                <span class="dropdown-item-desc">Ecosistema Canvora Group</span>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ request()->routeIs('tecnologia') ? 'active' : '' }}" href="{{ route('tecnologia') }}" role="menuitem">
                            <div class="dropdown-item-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width:18px;height:18px;min-width:18px;max-width:18px;display:block;">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                                    <line x1="8" y1="21" x2="16" y2="21" />
                                    <line x1="12" y1="17" x2="12" y2="21" />
                                </svg>
                            </div>
                            <div class="dropdown-item-text">
                                <span class="dropdown-item-title">Canvora Tech</span>
                                <span class="dropdown-item-desc">Desarrollo & Software</span>
                            </div>
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('store') ? 'active' : '' }}" href="{{ route('store') }}" role="menuitem">
                            <div class="dropdown-item-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width:18px;height:18px;min-width:18px;max-width:18px;display:block;">
                                    <circle cx="9" cy="21" r="1" />
                                    <circle cx="20" cy="21" r="1" />
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                </svg>
                            </div>
                            <div class="dropdown-item-text">
                                <span class="dropdown-item-title">Canvora Store</span>
                                <span class="dropdown-item-desc">Equipos & Hardware</span>
                            </div>
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('inflables') ? 'active' : '' }}" href="{{ route('inflables') }}" role="menuitem">
                            <div class="dropdown-item-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width:18px;height:18px;min-width:18px;max-width:18px;display:block;">
                                    <path d="M3 11l19-9-9 19-2-8-8-2z" />
                                </svg>
                            </div>
                            <div class="dropdown-item-text">
                                <span class="dropdown-item-title">Inflables Publicitarios</span>
                                <span class="dropdown-item-desc">Activaciones & Gran Formato</span>
                            </div>
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('marketing') ? 'active' : '' }}" href="{{ route('marketing') }}" role="menuitem">
                            <div class="dropdown-item-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width:18px;height:18px;min-width:18px;max-width:18px;display:block;">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                            </div>
                            <div class="dropdown-item-text">
                                <span class="dropdown-item-title">Marketing & Publicidad</span>
                                <span class="dropdown-item-desc">Branding & Campañas Digitales</span>
                            </div>
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('contabilidad') ? 'active' : '' }}" href="{{ route('contabilidad') }}" role="menuitem">
                            <div class="dropdown-item-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width:18px;height:18px;min-width:18px;max-width:18px;display:block;">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                    <line x1="16" y1="13" x2="8" y2="13" />
                                    <line x1="16" y1="17" x2="8" y2="17" />
                                </svg>
                            </div>
                            <div class="dropdown-item-text">
                                <span class="dropdown-item-title">Servicios Contables</span>
                                <span class="dropdown-item-desc">Asesoría & Gestión Tributaria</span>
                            </div>
                        </a>
                    </div>
                </div>
                <a class="nav-link" href="{{ request()->routeIs('marketing') ? route('marketing') . '#contacto-marketing' : (request()->routeIs('contabilidad') ? route('contabilidad') . '#contacto-contabilidad' : (request()->routeIs('inflables') ? route('inflables') . '#contacto-inflables' : route('inicio') . '#contacto')) }}">Contacto</a>
                <a class="button" href="{{ $headerContactoUrl }}" @if($headerTelefono !=='' ) target="_blank" rel="noopener noreferrer" @endif>
                    Cotizar
                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </nav>
        </div>
    </header>
<script>
(() => {
    const header = document.querySelector('.site-header');
    if (!header || header.dataset.menuInitialized) return;
    header.dataset.menuInitialized = 'true';
    const toggle = header.querySelector('#menu-toggle');
    const navigation = header.querySelector('#navigation');
    const dropdown = header.querySelector('#nav-dropdown-nosotros');
    const dropdownButton = dropdown?.querySelector('.nav-dropdown-btn');
    if (!toggle || !navigation) return;
    function closeDropdown() {
        dropdown?.classList.remove('open');
        dropdownButton?.setAttribute('aria-expanded', 'false');
    }
    function closeMenu() {
        navigation.classList.remove('open');
        document.body.classList.remove('menu-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Abrir menú');
        closeDropdown();
    }
    toggle.addEventListener('click', (event) => {
        event.stopImmediatePropagation();
        const open = navigation.classList.toggle('open');
        document.body.classList.toggle('menu-open', open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
        if (!open) closeDropdown();
    });
    dropdownButton?.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopImmediatePropagation();
        const open = dropdown.classList.toggle('open');
        dropdownButton.setAttribute('aria-expanded', String(open));
    });
    navigation.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    document.addEventListener('click', (event) => {
        if (dropdown && !dropdown.contains(event.target)) closeDropdown();
        if (!header.contains(event.target)) closeMenu();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        const menuOpen = navigation.classList.contains('open');
        const dropdownOpen = dropdown?.classList.contains('open');
        closeMenu();
        if (menuOpen) toggle.focus();
        else if (dropdownOpen) dropdownButton?.focus();
    });
    window.matchMedia('(min-width: 851px)').addEventListener('change', event => {
        if (event.matches) closeMenu();
    });
    header.querySelector('.brand')?.addEventListener('click', (event) => {
        const home = new URL(event.currentTarget.href, window.location.origin);
        const normalize = path => path.replace(/\/+$/, '');
        if (home.origin === window.location.origin &&
            normalize(home.pathname) === normalize(window.location.pathname)) {
            event.preventDefault();
            closeMenu();
            history.replaceState(null, '', home.pathname + home.search);
            window.scrollTo({
                top: 0,
                behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches
                    ? 'auto' : 'smooth'
            });
        }
    });
})();
</script>
