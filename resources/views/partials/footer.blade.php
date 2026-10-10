@php
    $cvTelefono = preg_replace(
        '/\D/',
        '',
        (string) config('canvora.whatsapp', '51941765588')
    ) ?: '51941765588';

    $cvWhatsapp = 'https://wa.me/' . $cvTelefono
        . '?text=' . rawurlencode('Hola Canvora, quisiera más información.');
@endphp

<footer class="cv-footer">
    <div class="cv-footer__inner">

        <a
            class="cv-footer__logo"
            href="{{ url('/') }}"
            aria-label="Canvora Group, inicio"
        >
            <img
                src="{{ asset('images/canvora-logo.png') }}"
                alt="Canvora Group"
                width="1774"
                height="887"
                loading="lazy"
            >
        </a>

        <p>© {{ date('Y') }} Canvora Group.</p>

        <nav class="cv-footer__links" aria-label="Soluciones de Canvora">
            <a href="{{ url('/tecnologia') }}">Tech</a>
            <a href="{{ url('/inflables') }}">Inflables</a>
            <a href="{{ url('/store') }}">Store</a>
        </nav>

    </div>
</footer>

<a
    class="cv-whatsapp"
    href="{{ $cvWhatsapp }}"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Contactar por WhatsApp"
    title="Escríbenos por WhatsApp"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        aria-hidden="true"
    >
        <path
            fill="currentColor"
            d="M20.52 3.48A11.9 11.9 0 0 0 12.04 0C5.46 0 .11 5.35.1 11.93c0 2.1.55 4.15 1.59 5.96L0 24l6.26-1.64a11.94 11.94 0 0 0 5.77 1.47h.01c6.58 0 11.93-5.35 11.96-11.93a11.86 11.86 0 0 0-3.48-8.42ZM12.04 21.8a9.9 9.9 0 0 1-5.04-1.38l-.36-.21-3.72.97.99-3.63-.24-.37a9.9 9.9 0 0 1-1.52-5.25c0-5.47 4.45-9.92 9.93-9.92a9.85 9.85 0 0 1 7.02 2.91 9.85 9.85 0 0 1 2.9 7.02c-.01 5.48-4.46 9.86-9.96 9.86Zm5.45-7.43c-.3-.15-1.77-.87-2.04-.97-.28-.1-.48-.15-.68.15-.2.3-.77.97-.94 1.17-.18.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.18-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.2 5.09 4.48.71.31 1.27.49 1.71.62.72.23 1.37.2 1.88.12.57-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.13-.27-.2-.57-.35Z"
        />
    </svg>
</a>