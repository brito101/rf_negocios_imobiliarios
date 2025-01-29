@extends('web.master.master')

@section('css')
    <style>
        li::marker {
            font-size: 0;
        }
    </style>
@endsection

@section('content')
    <section class="main_property">
        <div class="main_property_header py-5 bg-light">
            <div class="container">
                <h1 class="text-title">{{ $property->title }}</h1>
                <p class="mb-0 text-support">{{ $property->type->category->name }} - {{ $property->type->name }}
                    {{ $property->neighborhood ? ' - ' . $property->neighborhood : '' }}</p>
            </div>
        </div>

        <div class="main_property_content py-5">
            <div class="container">
                <div class="row">
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
                                                    data-toggle="lightbox" data-gallery="property-gallery" data-type="image"
                                                    target="_blank">
                                                    <img src="{{ url('storage/properties/' . $image->location) }}"
                                                        class="d-block w-100" alt="{{ $property->title }}">
                                                </a>
                                            @else
                                                <a href="{{ url('storage/properties/album/' . $image->location) }}"
                                                    data-toggle="lightbox" data-gallery="property-gallery" data-type="image"
                                                    target="_blank">
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


                        <div class="main_property_price pt-4 text-support">
                            @if ($property->condominium && $property->condominium != '0,00')
                                <p class="main_property_price_small">
                                    {{ 'Condomínio: ' . $property->condominium }}
                                </p>
                            @endif

                            @switch($property->goal)
                                @case('Venda')
                                    <p class="main_property_price_big">Valor do Imóvel: {{ $property->sale_price }}</p>
                                @break

                                @case('Locação')
                                    <p class="main_property_price_big">Valor do Imóvel: {{ $property->sale_price }}</p>
                                @break

                                @case('Venda ou Locação')
                                    <p class="main_property_price_big">Valor do Imóvel: {{ $property->sale_price }} <br>
                                        ou Valor do Aluguel: {{ $property->rent_price }}/mês</p>
                                @break

                                @default
                                    <p>Entre em contato com a nossa equipe comercial!</p>
                            @endswitch

                        </div>

                        @if ($property->description)
                            <div class="main_property_content_description">
                                <h2 class="text-title">Conheça mais o imóvel</h2>
                                {!! $property->description !!}
                            </div>
                        @endif

                        <div class="main_property_content_features">
                            <h2 class="text-title">Características</h2>
                            <table class="table table-striped" style="margin-bottom: 40px;">
                                <tbody>
                                    @if ($property->bedrooms)
                                        <tr>
                                            <td>Dormitórios</td>
                                            <td>{{ $property->bedrooms }}</td>
                                        </tr>
                                    @endif
                                    @if ($property->suites)
                                        <tr>
                                            <td>Suítes</td>
                                            <td>{{ $property->suites }}</td>
                                        </tr>
                                    @endif
                                    @if ($property->bedrooms)
                                        <tr>
                                            <td>Banheiros</td>
                                            <td>{{ $property->bathrooms }}</td>
                                        </tr>
                                    @endif
                                    @if ($property->rooms)
                                        <tr>
                                            <td>Salas</td>
                                            <td>{{ $property->rooms }}</td>
                                        </tr>
                                    @endif
                                    @if ($property->garage)
                                        <tr>
                                            <td>Garagem</td>
                                            <td>{{ $property->garage }}</td>
                                        </tr>
                                    @endif
                                    @if ($property->garage_covered)
                                        <tr>
                                            <td>Garagem Coberta</td>
                                            <td>{{ $property->garage_covered }}</td>
                                        </tr>
                                    @endif
                                    @if ($property->area_total)
                                        <tr>
                                            <td>Área Total</td>
                                            <td>{{ $property->area_total }} m<sup>2</sup></td>
                                        </tr>
                                    @endif
                                    @if ($property->area_util)
                                        <tr>
                                            <td>Área Útil</td>
                                            <td>{{ $property->area_util }} m<sup>2</sup></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if (count($property->differentials) > 0)
                            <div class="main_property_structure">
                                <h2 class="text-title">Estrutura</h2>
                                <div class="d-flex flex-wrap justify-content-start gap-2">
                                    @foreach ($property->differentials as $item)
                                        <span class="main_property_structure_item mx-0"><i class="fa fa-check me-1"></i>
                                            {{ $item->differential->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="main_property_location mb-3">
                            <h2 class="text-title">Localização</h2>
                            <div id="map" style="width: 100%; min-height: 400px;"></div>
                        </div>

                    </div>

                    <div class="col-12 col-lg-4 mt-md-0">
                        <a target="_blank"
                            href="https://api.whatsapp.com/send?phone={{ $property->user->cell ?? env('CELL') }}&text=Olá, me interessei sobre o seu anúncio."
                            class="btn btn-success btn-lg btn-block mb-3 w-100"><i class="fab fa-whatsapp me-2"></i>
                            Converse com o
                            Corretor!
                        </a>

                        <div class="main_property_contact">
                            <h2 class="bg-custom">Entre em contato</h2>

                            <form action="{{ route('web.contact.send') }}" method="post">
                                @if ($errors->any())
                                    <span class="text-danger">{{ $errors->first('property_id') }}</span>
                                @endif

                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <div class="mb-3">
                                    <label for="name">Seu nome:</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Informe seu nome completo" required value="{{ old('name') }}">
                                    @if ($errors->any())
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="telephone">Seu telefone:</label>
                                    <input type="tel" name="cell" id="cell" class="form-control"
                                        placeholder="Informe seu telefone com DDD" required value="{{ old('cell') }}">
                                    @if ($errors->any())
                                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="email">Seu e-mail:</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Informe seu melhor e-mail" required value="{{ old('email') }}">
                                    @if ($errors->any())
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
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


                        <div class="main_property_share">
                            <div class="fb-share-button me-2" data-href="{{ url()->current() }}"
                                data-layout="button_count" data-size="large">
                                <a target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&amp;src=sdkpreparse"
                                    class="fb-xfbml-parse-ignore">Compartilhar</a>
                            </div>
                            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"
                                data-size="large" data-text="{{ $property->title }}" data-url="{{ url()->current() }}"
                                data-hashtags="{{ env('APP_NAME') }}" data-related="RodrigoBritoDesenvolvedorWeb"
                                data-lang="pt" data-show-count="false">Tweet</a>
                            <a style="padding: 0 10px; margin: 0; font-size: 0.875em; padding-top: 2px;"
                                href="https://instagram.com/" target="_blank" class="btn btn-front ms-2"><i
                                    class="fab fa-instagram me-2"></i> Instagram</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom_js')
    <script>
        function markMap() {

            var locationJson = $.getJSON(
                'https://maps.googleapis.com/maps/api/geocode/json?address={{ $property->street }},+{{ $property->number }}+{{ $property->city }}+{{ $property->neighborhood }}&key={{ env('GOOGLE_MAPS_API_KEY') }}',
                function(response) {

                    lat = response.results[0].geometry.location.lat;
                    lng = response.results[0].geometry.location.lng;

                    var citymap = {
                        property: {
                            center: {
                                lat: lat,
                                lng: lng
                            },
                            population: 100
                        }
                    };

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 14,
                        center: {
                            lat: lat,
                            lng: lng
                        },
                        mapTypeId: 'terrain'
                    });

                    for (var city in citymap) {
                        var cityCircle = new google.maps.Circle({
                            strokeColor: '#FF0000',
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: '#FF0000',
                            fillOpacity: 0.35,
                            map: map,
                            center: citymap[city].center,
                            radius: Math.sqrt(citymap[city].population) * 100
                        });
                    }
                });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=markMap"></script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.3&appId={{ env('CLIENT_SOCIAL_FACEBOOK_APP') }}&autoLogAppEvents=1">
    </script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


    <script src="{{ asset('vendor/jquery/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('js/phone.js') }}"></script>
@endsection
