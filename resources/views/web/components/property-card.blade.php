<div class="col-12 col-md-6 {{ isset($page) && $page == 'filter' ? 'col-lg-6' : 'col-lg-4' }} mb-4">
    <article class="card main_properties_item shadow-sm">
        <div class="img-responsive-16by9">
            <a href="{{ route('web.property', ['slug' => $property->slug]) }}">
                @if ($property->cover)
                    <img src="{{ url('storage/properties/min/' . $property->cover) }}" class="card-img-top"
                        alt="{{ $property->title }}">
                @else
                    <img src="{{ asset('img/share.webp') }}" class="card-img-top" alt="{{ $property->title }}">
                @endif
            </a>
        </div>
        <div class="card-body">
            <h2><a href="{{ route('web.property', ['slug' => $property->slug]) }}"
                    class="text-title">{{ $property->title }}</a></h2>
            <p class="main_properties_item_category text-back text-front mb-0">
                {{ $property->type->category->name }}</p>
            <p class="main_properties_item_type text-front mt-0">{{ $property->type->name }}
                @if ($property->neighborhood)
                    {{ ' - ' . $property->neighborhood }} <i class="fa fa-map"></i>
                @endif
                @if ($type)
                    @if ($type == 'sale')
                        <p class="main_properties_price text-front">
                            {{ $property->sale_price }}
                        </p>
                    @else
                        <p class="main_properties_price text-front">
                            {{ $property->rent_price }}/mês
                        </p>
                    @endif
                @else
                    @if ($property->goal == 'Venda')
                        <p class="main_properties_price text-front">
                            {{ $property->sale_price }}
                        </p>
                    @elseif ($property->goal == 'Aluguel')
                        <p class="main_properties_price text-front">
                            {{ $property->rent_price }}/mês
                        </p>
                    @else
                        <p class="main_properties_price text-front">
                            {{ $property->sale_price . ' ou ' . $property->rent_price }}/mês
                        </p>
                    @endif
                @endif
                <a href="{{ route('web.property', ['slug' => $property->slug]) }}"
                    class="btn-custom text-opposit d-block shadow-sm font-weight-bold">Ver Imóvel</a>
        </div>
        <div class="card-footer d-flex">
            <div class="main_properties_features col-4 text-center">
                <img src="{{ asset('img/icons/bed.png') }}" class="img-fluid" alt="Quartos" width="40"
                    height="40">
                <p class="text-muted">{{ $property->bedrooms ?? 0 }}</p>
            </div>

            <div class="main_properties_features col-4 text-center">
                <img src="{{ asset('img/icons/garage.png') }}" class="img-fluid" alt="Garagem" width="40"
                    height="40">
                <p class="text-muted">{{ $property->garage + $property->garage_covered }}</p>
            </div>

            <div class="main_properties_features col-4 text-center">
                <img src="{{ asset('img/icons/util-area.png') }}" class="img-fluid" alt="Área útil" width="40"
                    height="40">
                <p class="text-muted">{{ $property->area_util ?? 0 }} m&sup2;</p>
            </div>
        </div>
    </article>
</div>
