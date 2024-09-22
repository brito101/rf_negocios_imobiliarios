<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @metas
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url(asset('css/site.css')) }}">
    @hasSection('css')
        @yield('css')
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/webp" href="{{ asset('img/logo.webp') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @if ($cookieConsent == 'accept')
        @include('web._partials.gtm-head')
    @endif

</head>

<body>

    @if ($cookieConsent == 'accept')
        @include('web._partials.gtm-body')
    @endif

    <header class="main_header">
        <div class="header_bar">
            <div class="container">
                <div class="row py-1 d-flex justify-content-md-around">

                    <div class="d-none d-lg-flex col-lg-4 justify-content-center align-items-center p-2 text-opposit">
                        <i class="fa fa-map-marked-alt me-3"></i>
                        <p class="my-auto ml-3">Rua Oito, 14 - Coqueiral de Itaparica<br />Vila Velha-ES</p>
                    </div>

                    <div
                        class="d-none d-md-flex col-md-6 col-lg-4 justify-content-center align-items-center p-2 text-opposit">
                        <i class="fa fa-clock me-3"></i>
                        <p class="my-auto ml-3">Seg/Sex: 09:00h - 19:00h<br />Sáb/Dom: Plantão</p>
                    </div>

                    <div
                        class="d-flex col-12 col-md-6 col-lg-4 justify-content-center align-items-center p-2 mx-auto text-opposit">
                        <i class="fa fa-envelope me-3"></i>
                        <p class="my-auto ml-3">contato@rfnegociosimobiliarios.com.br<br />+55 (27) 99696-9639</p>
                    </div>

                </div>
            </div>
        </div>

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

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Menu Principal">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="{{ route('web.home') }}" class="nav-link text-support">Home</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('web.sale') }}" class="nav-link text-support">Comprar</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('web.rent') }}" class="nav-link text-support">Alugar</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('web.contact') }}"
                                class="nav-link text-support">Contato</a></li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>

    @yield('content')

    <article class="main_optin text-white py-5">
        <div class="container">
            <div class="row mx-auto" style="max-width: 600px;">
                <h1>Quer ficar por dentro da novidades?</h1>

                <p>Deixe o seu nome e seu melhor e-mail nos campos abaixo e nós vamos lhe informar sobre os melhores
                    negócios e todos os lançamentos do Espirito Santo</p>

                <form action="{{ route('web.contact.send') }}" method="post" autocomplete="off">
                    @csrf
                    <input type="text" class="form-control" name="name" placeholder="Digite seu nome"
                        size="50" required value="{{ old('name') }}">
                    @if ($errors->any())
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <input type="email" class="form-control" name="email" placeholder="Digite seu melhor e-mail"
                        size="50" required value="{{ old('email') }}">
                    @if ($errors->any())
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <input class="d-none" name="message" value="Quero receber notícias de lançamentos e novidades">
                    @if ($errors->any())
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    @endif
                    <button type="submit" class="btn-custom text-opposit shadow-sm">Me avise!</button>
                </form>
            </div>
        </div>
    </article>

    <footer>
        <section class="main_footer bg-light">
            <div class="container pt-5" style="padding-bottom: 120px;">

                <div class="row d-flex justify-content-around text-muted">

                    <div class="col-12 col-md-3 col-lg-3">
                        <h1 class="pb-2">Navegue <span class="text-front">Aqui!</span></h1>
                        <ul>
                            <li><a href="{{ route('web.home') }}" class="text-back text-decoration-none">Home</a>
                            </li>
                            <li><a href="{{ route('web.sale') }}" class="text-back text-decoration-none">Comprar</a>
                            </li>
                            <li><a href="{{ route('web.rent') }}" class="text-back text-decoration-none">Alugar</a>
                            </li>
                            <li><a href="{{ route('web.contact') }}"
                                    class="text-back text-decoration-none">Contato</a>
                            </li>
                            <li><a href="{{ route('web.policy') }}" class="text-back text-decoration-none">Política
                                    de
                                    Privacidade</a></li>
                        </ul>
                    </div>

                    <div class="col-12 col-md-9 col-lg-6">
                        <h1 class="pb-2">Nos <span class="text-front">Conheça!</span></h1>
                        <p>Nossa maior satisfação é lhe ajudar a encontrar seu imóvel dos sonhos em Espírito Santo.</p>

                        <h1 class="pb-2">Quer <span class="text-front">Investir?</span></h1>
                        <p>Entre em contato com a nossa equipe e vamos lhe informar sempre sobre os melhores negócios.
                        </p>
                    </div>

                    <div class="col-12 col-md-12 col-lg-3 text-center">
                        {{-- <a href="{{ env('CLIENT_DATA_LINK_FACEBOOK') }}" target="_blank"><i
                                class="fab fa-facebook btn-custom text-opposit" aria-label="Facebook" title="Facebook"></i></a> --}}
                        <a href="{{ env('CLIENT_DATA_LINK_INSTAGRAM') }}" target="_blank" class="mx-1"><i
                                class="fab fa-instagram btn-custom text-opposit" aria-label="Instagram" title="Instagram"></i></a>
                        {{-- <a href="{{ env('CLIENT_DATA_LINK_YOUTUBE') }}" target="_blank"><i
                                class="fab fa-youtube btn-custom text-opposit" aria-label="Youtube" title="Youtube"></i></a> --}}

                    </div>
                </div>
            </div>
        </section>

        <div class="main_copyright py-3 text-opposit text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0">CRECI 14084-F | CNPJ: 01.128.633/0001-42 | Vila Velha-ES</p>
                        <p class="mb-0">Todos os Direitos Reservados - {{ env('APP_NAME') }} ®</p>
                        <p class="mb-0">Desenvolvido com <i class="fa fa-heart me-2"></i>por
                            <a href="https://www.rfnegociosimobiliarios.com.br" class="text-white text-decoration-none">
                                RF Imóveis</a>
                        </p>
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
                    <a data-action="{{ route('web.cookie.consent') }}" data-cookie="accept" href="#"
                        class="btn float-right btn-custom"><i class="fas fa-thumbs-up me-2"></i> Sim, eu aceito.
                    </a>
                    <a data-action="{{ route('web.cookie.consent') }}" data-cookie="decline" href="#"
                        class="btn float-right btn-custom icon-thumbs-down"><i class="fas fa-thumbs-down me-2"></i>
                        Não,
                        eu não aceito.
                    </a>
                </div>
            </div>
        </div>
    @endif

    <button aria-label="Voltar ao topo da página" title="Voltar ao topo da página"
        class="smoothScroll-top p-0 text-center"><i class="fas fa-chevron-up mx-auto"></i></button>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/cookie.js') }}"></script>
    <script src="{{ asset('js/button-top.js') }}"></script>
    @yield('custom_js')

</body>

</html>
