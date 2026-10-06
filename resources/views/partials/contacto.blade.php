@php
    $numero = preg_replace('/\D/', '', config('canvora.whatsapp', ''));

    $textoConsulta = $mensajeContacto
        ?? 'Hola, quisiera información sobre CANVORA GROUP.';

    $enlaceContacto = $numero !== ''
        ? 'https://wa.me/' . $numero . '?text=' . rawurlencode($textoConsulta)
        : '#contacto';
@endphp

<section
    class="contact"
    id="contacto"
    aria-labelledby="contact-title">

    <img
        class="contact-background"
        src="{{ asset('images/contacto.png') }}"
        width="1672"
        height="941"
        alt=""
        loading="lazy"
        decoding="async">

    <div class="container contact-inner">
        <div class="contact-copy contact-card-glass" data-3d-tilt>
            <p class="eyebrow" style="color: var(--c-cyan);">
                {{ $etiquetaContacto ?? '✦ Hagamos crecer tu negocio' }}
            </p>

            <h2 id="contact-title" style="color: #ffffff;">
                {{ $tituloContacto ?? 'Cuéntanos tu proyecto.' }}
            </h2>

            <p class="contact-description" style="color: #cbd5e1;">
                {{ $descripcionContacto
                    ?? 'Conversemos sobre tus necesidades y encontremos la solución adecuada para tu negocio.' }}
            </p>

            <div class="contact-actions">
                <a
                    class="button btn-primary-3d"
                    href="{{ $enlaceContacto }}"
                    @if($numero !== '')
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif>
                    Solicitar cotización
                    <svg aria-hidden="true">
                        <use href="#icon-arrow"/>
                    </svg>
                </a>

                @if($numero !== '')
                    <a
                        class="button btn-outline-3d"
                        href="{{ $enlaceContacto }}"
                        target="_blank"
                        rel="noopener noreferrer">
                        <svg aria-hidden="true">
                            <use href="#icon-chat"/>
                        </svg>
                        Hablemos por WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>