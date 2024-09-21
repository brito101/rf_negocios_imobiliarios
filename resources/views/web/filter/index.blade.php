@extends('web.master.master')

@section('content')
    <div class="main_filter bg-light py-5">
        <div class="container">
            <section class="row">
                <div class="col-12">
                    <h2 class="text-front mb-5"><i class="fa fa-search-plus me-2"></i> Filtro</h2>
                </div>

                <div class="col-12 col-md-4">
                    <form action="{{ route('web.filter') }}" method="post" class="w-100 p-3 bg-white mb-5 shadow-sm">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label for="goal" class="mb-2 text-back">Comprar ou Alugar?</label>
                                <select class="form-select" aria-label="Escolha..." id="goal"
                                    data-url="{{ route('web.categories') }}" name="goal">
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="Venda">Comprar</option>
                                    <option value="Locação">Alugar</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="category" class="mb-2 text-back">O que você quer?</label>
                                <select class="form-select" aria-label="Escolha..." id="category"
                                    data-url="{{ route('web.types') }}" name="category">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="type" class="mb-2 text-back">Qual o tipo do imóvel?</label>
                                <select class="form-select" aria-label="Escolha..." id="type"
                                    data-url="{{ route('web.cities') }}" name="type">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="city" class="mb-2 text-back">Onde você quer?</label>
                                <select class="form-select" aria-label="Escolha..." id="city"
                                    data-url="{{ route('web.bedrooms') }}" name="city">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="bedroom" class="mb-2 text-back">Quartos</label>
                                <select class="form-select" aria-label="Escolha..." id="bedroom"
                                    data-url="{{ route('web.suites') }}" name="bedroom">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="suite" class="mb-2 text-back">Suítes</label>
                                <select class="form-select" aria-label="Escolha..." id="suite"
                                    data-url="{{ route('web.bathrooms') }}" name="suite">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="bathroom" class="mb-2 text-back">Banheiros</label>
                                <select class="form-select" aria-label="Escolha..." id="bathroom"
                                    data-url="{{ route('web.garages') }}" name="bathroom">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="garage" class="mb-2 text-back">Garagem</label>
                                <select class="form-select" aria-label="Escolha..." id="garage"
                                    data-url="{{ route('web.base-price') }}" name="garage">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="base_price" class="mb-2 text-back">Preço Base</label>
                                <select class="form-select" aria-label="Escolha..." id="base_price"
                                    data-url="{{ route('web.base-price') }}" name="base_price">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="limit_price" class="mb-2 text-back">Preço Limite</label>
                                <select class="form-select" aria-label="Escolha..." id="limit_price" name="limit_price">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="col-12 text-right mt-3 button_search">
                                <button class="btn-custom text-opposit" type="submit"><i class="fa fa-search me-2"></i>
                                    Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-md-8">
                    <section class="row main_properties">
                        @if ($properties->count())
                            @foreach ($properties as $property)
                                @include('web.components.property-card', [
                                    'property' => $property,
                                    'type' => $type,
                                    'page' => 'filter',
                                ])
                            @endforeach

                            <div class="d-flex flex-wrap justifty-content-center">
                                {{ $properties->links() }}
                            </div>
                        @else
                            <div class="col-12 p-5 bg-white shadow-sm">
                                <h2 class="text-front text-center"><i class="fa fa-frown"></i> Não encontramos nenhum
                                    imóvel para você
                                    comprar ou alugar!</h2>
                                <p class="text-center text-support">Utilize o filtro avançado para encontrar o imóvel dos
                                    seus sonhos...</p>
                            </div>
                        @endif


                    </section>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('js/properties-filter.js') }}"></script>
@endsection
