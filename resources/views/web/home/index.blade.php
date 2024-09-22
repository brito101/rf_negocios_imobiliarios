@extends('web.master.master')

@section('content')
    <div class="main_slide d-none d-sm-block">
        <div class="container" style="height: 100%;">
            <div class="row align-items-center" style="height: 100%;">
                <div class="col-lg-9">
                    <p class="main_slide_content text-opposit">EXPERIÊNCIA DE ENCONTRAR O <span>IMÓVEL</span>
                        DOS <span>SONHOS</span> PARA UMA FAMÍLIA <span>FELIZ</span>!</p>
                    <a href="{{ route('web.sale') }}" class="btn-custom-2 text-opposit me-2" style="font-size: 1.4rem;">Quero
                        <b>Comprar</b>!</a>
                    <a href="{{ route('web.rent') }}" class="btn-custom text-opposit" style="font-size: 1.4rem;">Quero
                        <b>Alugar</b>!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="main_filter">
        <div class="container my-5">
            <form action="{{ route('web.filter') }}" method="post" class="w-100 py-3">
                @csrf
                <div class="row d-flex flex-wrap justify-content-center">
                    <div class="mb-3 col-12 col-md-3">
                        <label for="goal" class="mb-2 text-back">Comprar ou Alugar?</label>
                        <select class="form-select" aria-label="Escolha..." id="goal"
                            data-url="{{ route('web.categories') }}" name="goal">
                            <option value="" disabled selected>Selecione</option>
                            <option value="Venda">Comprar</option>
                            <option value="Locação">Alugar</option>
                        </select>
                    </div>

                    <div class="mb-3 col-12 col-md-3">
                        <label for="category" class="mb-2 text-back">O que você quer?</label>
                        <select class="form-select" aria-label="Escolha..." id="category"
                            data-url="{{ route('web.types') }}" name="category">
                            <option value="" disabled selected>Selecione o filtro anterior</option>
                        </select>
                    </div>

                    <div class="mb-3 col-12 col-md-3">
                        <label for="type" class="mb-2 text-back">Qual o tipo do imóvel?</label>
                        <select class="form-select" aria-label="Escolha..." id="type"
                            data-url="{{ route('web.cities') }}" name="type">
                            <option value="" disabled selected>Selecione o filtro anterior</option>
                        </select>
                    </div>

                    <div class="mb-3 col-12 col-md-3">
                        <label for="city" class="mb-2 text-back">Onde você quer?</label>
                        <select class="form-select" aria-label="Escolha..." id="city"
                            data-url="{{ route('web.bedrooms') }}" name="city">
                            <option value="" disabled selected>Selecione o filtro anterior</option>
                        </select>
                    </div>

                    <div class="form_advanced" style="display: none;">
                        <div class="row d-flex flex-wrap justify-content-center">
                            <div class="mb-3 col-12 col-md-3">
                                <label for="bedroom" class="mb-2 text-back">Quartos</label>
                                <select class="form-select" aria-label="Escolha..." id="bedroom"
                                    data-url="{{ route('web.suites') }}" name="bedroom">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12 col-md-3">
                                <label for="suite" class="mb-2 text-back">Suítes</label>
                                <select class="form-select" aria-label="Escolha..." id="suite"
                                    data-url="{{ route('web.bathrooms') }}" name="suite">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12 col-md-3">
                                <label for="bathroom" class="mb-2 text-back">Banheiros</label>
                                <select class="form-select" aria-label="Escolha..." id="bathroom"
                                    data-url="{{ route('web.garages') }}" name="bathroom">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12 col-md-3">
                                <label for="garage" class="mb-2 text-back">Garagem</label>
                                <select class="form-select" aria-label="Escolha..." id="garage"
                                    data-url="{{ route('web.base-price') }}" name="garage">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12 col-md-6">
                                <label for="base_price" class="mb-2 text-back">Preço Base</label>
                                <select class="form-select" aria-label="Escolha..." id="base_price"
                                    data-url="{{ route('web.base-price') }}" name="base_price">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12 col-md-6">
                                <label for="limit_price" class="mb-2 text-back">Preço Limite</label>
                                <select class="form-select" aria-label="Escolha..." id="limit_price" name="limit_price">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mt-3">
                        <a href="" class="text-front open_filter text-decoration-none">Filtro avançado
                            ↓</a>
                    </div>

                    <div class="col-12 col-md-6 text-right mt-3 button_search">
                        <button class="btn-custom text-opposit float-end" type="submit"><i
                                class="fa fa-search me-2"></i>
                            Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @if ($experiences->count() > 0)
        <section class="main_list_group py-5 bg-light">
            <div class="container">
                <div class="p-4 main_list_group_title">
                    <h2 class="text-center text-support">Ambiente no seu <span class="text-front"><b>estilo</b></span>
                    </h2>
                    <p class="text-center text-muted mb-0 h4">Encontre o imóvel com a experiência que você quer viver</p>
                </div>

                <div class="main_list_group_item row mt-5 d-flex justify-content-around">
                    @foreach ($experiences as $experience)
                        <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                            <a href="{{ route('web.experience', ['slug' => $experience->slug]) }}">
                                <div class="d-flex align-items-center justify-content-center shadow-sm rounded"
                                    style="background: url({{ $experience->cover }}) no-repeat; background-size: cover;">
                                    <h2 class="text-opposit">{{ $experience->name }}</h2>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($propertiesForSale->count() > 0)
        <section class="main_properties py-5">
            <div class="container">
                <header class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
                    <h2 class="text-front main_properties_title">À Venda</h2>
                    <a href="{{ route('web.sale') }}"
                        class="badge badge-front p-2 text-opposit text-decoration-none text-bold">Ver
                        mais</a>
                </header>

                <div class="row d-flex justify-content-center">
                    @foreach ($propertiesForSale as $property)
                        @include('web.components.property-card', [
                            'property' => $property,
                            'type' => 'sale',
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($propertiesForRent->count() > 0)
        <section class="main_properties py-5 bg-light">
            <div class="container">
                <header class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="text-front main_properties_title">Para Alugar</h2>
                    <a href="{{ route('web.rent') }}"
                        class="badge badge-front p-2 text-opposit text-decoration-none text-bold">Ver
                        mais</a>
                </header>

                <div class="row d-flex justify-content-center">
                    @foreach ($propertiesForRent as $property)
                        @include('web.components.property-card', [
                            'property' => $property,
                            'type' => 'rent',
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@section('custom_js')
    <script src="{{ asset('js/properties-filter.js') }}"></script>
@endsection
