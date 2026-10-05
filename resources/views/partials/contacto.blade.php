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
        <div class="contact-copy">
            <p class="eyebrow">
                {{ $etiquetaContacto ?? 'Hagamos crecer tu negocio' }}
            </p>

            <h2 id="contact-title">
                {{ $tituloContacto ?? 'Cuéntanos tu proyecto.' }}
            </h2>

            <p class="contact-description">
                {{ $descripcionContacto
                    ?? 'Conversemos sobre tus necesidades y encontremos la solución adecuada para tu negocio.' }}
            </p>

            <div class="contact-actions">
                <a
                    class="button"
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
                        class="button button-outline"
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