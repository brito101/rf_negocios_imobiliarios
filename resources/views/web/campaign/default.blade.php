<!--
@born April 16, 2024
@author Rodrigo Brito <contato@rodrigobrito.dev.br>
-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @metas

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/campaign/default.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/webp" href="{{ asset('img/logo.webp') }}" />

    @if ($cookieConsent == 'accept')
        {!! $property->header_pixel !!}
    @endif

</head>

<body>
    @if ($cookieConsent == 'accept')
        {!! $property->body_pixel !!}
    @endif

    <header>
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <div class="navbar-brand">
                    <a href="{{ route('web.home') }}"
                        class="d-flex justify-content-center align-items-center text-decoration-none">
                        <img src="{{ url(asset('img/brand.webp')) }}" alt="{{ env('APP_NAME') }}"
                        class="brand-image-custom" width="150" height="109">
                        <h1 class="ms-3 d-none d-lg-block">Negócios Imobiliários</h1>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-5">

        <section id="hero">
            <div class="mb-5">
                <h2>Descubra o Seu Novo Lar no Bairro {{ $property->neighborhood }}, {{ $property->city }}</h2>
                <p>{{ $property->headline }}</p>
            </div>

            <div class="d-flex flex-wrap justify-content-center">
                <div class="col-12 col-lg-8 px-lg-4">
                    @if ($property->images->count() > 0 && !$property->video)
                        <div class="pt-5 pb-3 col-12">
                            <div id="carouselProperty" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @if (count($property->images) > 0)
                                        @foreach ($property->images as $image)
                                            <li data-target="#carouselProperty"
                                                data-slide-to="{{ $loop->iteration - 1 }}" {!! $loop->iteration == 1 ? 'class="active"' : '' !!}>
                                            </li>
                                        @endforeach
                                    @endif
                                </ol>

                                <div class="carousel-inner">
                                    @if (count($property->images) > 0)
                                        @foreach ($property->images->sortBy('order') as $image)
                                            <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                                                @if ($image->type == 'cover')
                                                    <a href="{{ url('storage/properties/' . $image->location) }}"
                                                        data-toggle="lightbox" data-gallery="property-gallery"
                                                        data-type="image" target="_blank">
                                                        <img src="{{ url('storage/properties/' . $image->location) }}"
                                                            class="d-block w-100" alt="{{ $property->title }}">
                                                    </a>
                                                @else
                                                    <a href="{{ url('storage/properties/album/' . $image->location) }}"
                                                        data-toggle="lightbox" data-gallery="property-gallery"
                                                        data-type="image" target="_blank">
                                                        <img src="{{ url('storage/properties/album/' . $image->location) }}"
                                                            class="d-block w-100" alt="{{ $property->title }}">
                                                    </a>
                                                @endif

                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <a class="carousel-control-prev" href="#carouselProperty" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselProperty" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($property->video)
                        <div class="pt-5 pb-3 col-12">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $property->video }}"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-lg-4 px-lg-4 pb-5 pb-lg-0">
                    <div id="contact">
                        <h3 class="bg-custom">Entre em contato</h3>
                        <form action="{{ route('web.contact.send') }}" method="post">
                            @if ($errors->any())
                                <span class="text-danger">{{ $errors->first('property_id') }}</span>
                            @endif

                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <div class="mb-3">
                                <label for="name">Nome Completo:</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Informe seu nome completo" required value="{{ old('name') }}">
                                @if ($errors->any())
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="telephone">Telefone:</label>
                                <input type="tel" name="cell" id="cell" class="form-control"
                                    placeholder="Informe seu telefone com DDD" required value="{{ old('cell') }}">
                                @if ($errors->any())
                                    <span class="text-danger">{{ $errors->first('cell') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Informe seu melhor e-mail" required value="{{ old('email') }}">
                                @if ($errors->any())
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="instagram">Instagram:</label>
                                <input type="text" name="instagram" class="form-control"
                                    placeholder="Informe seu Instagram" required value="{{ old('instagram') }}">
                                @if ($errors->any())
                                    <span class="text-danger">{{ $errors->first('instagram') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="message">Sua Mensagem:</label>
                                <textarea name="message" id="message" cols="30" rows="5" class="form-control">{{ old('message') ?? 'Quero ter mais informações sobre esse imóvel.' }}</textarea>
                                @if ($errors->any())
                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn-custom btn-block text-opposit w-100">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        @if ($property->differentials_resume)
            <section id="differentials">
                <h3>Características do imóvel</h3>
                <div>
                    {!! $property->differentials_resume !!}
                </div>
            </section>
        @endif

        @if ($property->images->count() > 0 && $property->video)
            <section class="pt-5 pb-3 px-lg-4">
                <div class="col-12 col-lg-8">
                    <div id="carouselProperty" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @if (count($property->images) > 0)
                                @foreach ($property->images as $image)
                                    <li data-target="#carouselProperty" data-slide-to="{{ $loop->iteration - 1 }}"
                                        {!! $loop->iteration == 1 ? 'class="active"' : '' !!}></li>
                                @endforeach
                            @endif
                        </ol>

                        <div class="carousel-inner">
                            @if (count($property->images) > 0)
                                @foreach ($property->images->sortBy('order') as $image)
                                    <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">

                                        @if ($image->type == 'cover')
                                            <a href="{{ url('storage/properties/' . $image->location) }}"
                                                data-toggle="lightbox" data-gallery="property-gallery"
                                                data-type="image" target="_blank">
                                                <img src="{{ url('storage/properties/' . $image->location) }}"
                                                    class="d-block w-100" alt="{{ $property->title }}">
                                            </a>
                                        @else
                                            <a href="{{ url('storage/properties/album/' . $image->location) }}"
                                                data-toggle="lightbox" data-gallery="property-gallery"
                                                data-type="image" target="_blank">
                                                <img src="{{ url('storage/properties/album/' . $image->location) }}"
                                                    class="d-block w-100" alt="{{ $property->title }}">
                                            </a>
                                        @endif

                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <a class="carousel-control-prev" href="#carouselProperty" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselProperty" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        @if ($property->neighborhood)
            <section class="pt-5" id="neighborhood">
                <p>Agende uma visita e venha conhecer seu novo lar no bairro {{ $property->neighborhood }}.</p>
            </section>
        @endif

    </main>

    <footer id="footer">
        <div class="container py-4 px-0">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="col-12 col-md-5 d-flex  align-items-center p-2">
                    <div><i class="fa fa-map-marked-alt me-4"></i></div>
                    <div>
                        <p class="m-0">Rua Oito, 14 - Coqueiral de Itaparica</p>
                        <p class="m-0">Vila Velha-ES</p>
                    </div>
                </div>
                <div class="col-12 col-md-3 d-flex align-items-center p-2">
                    <div><i class="fa fa-clock me-4"></i></div>
                    <div>
                        <p class="m-0">Seg/Sex: 09:00h - 19:00h</p>
                        <p class="m-0">Sáb/Dom: Plantão</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex align-items-center p-2">
                    <div><i class="fa fa-envelope me-4"></i></div>
                    <div>
                        <p class="m-0">contato@rfnegociosimobiliarios.com.br</p>
                        <p class="m-0">+55 (27) 99696-9639</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @if (!$cookieConsent)
        <div id="cookieConsent" class="fixed-bottom bg-dark py-3 text-white" style="opacity: .9;">
            <div class="container">
                <p>Este website utiliza cookies próprios e de terceiros a fim de personalizar o conteúdo, melhorar a
                    experiência
                    do usuário, fornecer funções de mídias sociais e analisar o tráfego. Para continuar navegando você
                    deve
                    concordar com nossa
                    <a href="{{ route('web.policy') }}" class="badge badge-front"><b>Política de Privacidade</b></a>
                </p>
                <div class="d-flex flex-wrap justify-content-end gap-2">
                    <a data-action="{{ route('web.cookie.consent-lp', ['id' => $property->id]) }}"
                        data-cookie="accept" href="#" class="btn float-right btn-custom"><i
                            class="fas fa-thumbs-up me-2"></i> Sim, eu aceito.
                    </a>
                    <a data-action="{{ route('web.cookie.consent-lp', ['id' => $property->id]) }}"
                        data-cookie="decline" href="#" class="btn float-right btn-custom icon-thumbs-down"><i
                            class="fas fa-thumbs-down me-2"></i>
                        Não,
                        eu não aceito.
                    </a>
                </div>
            </div>
        </div>
    @endif

    <button aria-label="Voltar ao topo da página" title="Voltar ao topo da página"
        class="smoothScroll-top p-0 text-center"><i class="fa fa-chevron-up mx-auto"></i></button>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/cookie.js') }}"></script>
    <script src="{{ asset('js/button-top.js') }}"></script>
</body>

</html>
