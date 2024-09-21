@extends('adminlte::page')

@section('title', '- Editar Propriedade')
@section('plugins.BootstrapSwitch', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Summernote', true)
@section('plugins.select2', true)
@section('plugins.BootstrapSelect', true)
@section('plugins.Summernote', true)

@section('adminlte_css')
    <style>
        li[aria-disabled='true'] {
            display: none;
        }

        .draggable-item {
            cursor: grab;
        }

        .draggable-item .dragging {
            cursor: grabbing;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection



@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-fw fa-home"></i> Editar Propriedade "{{ $property->title }}"</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Propriedades</a></li>
                        <li class="breadcrumb-item active">Editar Propriedade</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    @include('components.alert')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dados Cadastrais da Propriedade</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.properties.update', ['property' => $property->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="card-body">
                                <div class="d-flex flex-wrap justify-content-start">
                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="title">Título</label>
                                        <input type="text" class="form-control" id="title"
                                            placeholder="Título do Anúncio" name="title"
                                            value="{{ old('title') ?? $property->title }}" required>
                                    </div>

                                    <div class="col-12 col-md-6 form-group px-0 pl-md-2">
                                        <label for="headline">Headline</label>
                                        <input type="text" class="form-control" id="headline"
                                            placeholder="Texto da headline" name="headline"
                                            value="{{ old('headline') ?? $property->headline }}" required>
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <x-adminlte-input-file name="cover" label="Imagem de capa 860 x 490"
                                            placeholder="Selecione uma imagem..." legend="Selecionar" />
                                    </div>


                                    @if ($property->cover)
                                        <div class='col-12 align-self-center mb-3 d-flex justify-content-center px-0'>
                                            <img src="{{ url('storage/properties/' . $property->cover) }}"
                                                alt="{{ $property->title }}" title="{{ $property->title }}"
                                                class="img-thumbnail d-block">
                                        </div>
                                    @endif

                                    <div class="col-12 col-md-3 form-group px-0 pr-md-2">
                                        <label for="type_id">Tipo</label>
                                        <x-adminlte-select2 name="type_id" id="type_id" data-placeholder="Selecione..."
                                            required>
                                            @foreach ($types as $type)
                                                <option
                                                    {{ old('type_id') == $type->id ? 'selected' : ($property->type_id == $type->id ? 'selected' : '') }}
                                                    value="{{ $type->id }}" data-category={{ $type->category_id }}>
                                                    {{ $type->name }}</option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="experience_id">Experiência</label>
                                        <x-adminlte-select2 name="experience_id" id="experience_id" required>
                                            @foreach ($experiences as $experience)
                                                <option
                                                    {{ old('experience_id') == $experience->id ? 'selected' : ($property->experience_id == $experience->id ? 'selected' : '') }}
                                                    value="{{ $experience->id }}">{{ $experience->name }}</option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="goal">Finalidade</label>
                                        <x-adminlte-select2 name="goal" id="goal" required>
                                            <option
                                                {{ old('goal') == 'Venda' ? 'selected' : ($property->goal == 'Venda' ? 'selected' : '') }}>
                                                Venda</option>
                                            <option
                                                {{ old('goal') == 'Locação' ? 'selected' : ($property->goal == 'Locação' ? 'selected' : '') }}>
                                                Locação</option>
                                            <option
                                                {{ old('goal') == 'Venda ou Locação' ? 'selected' : ($property->goal == 'Venda ou Locação' ? 'selected' : '') }}>
                                                Venda ou
                                                Locação</option>
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pl-md-2">
                                        <label for="status_id">Status</label>
                                        <x-adminlte-select2 name="status" id="status_id" required>
                                            <option
                                                {{ old('status') == 'Disponível' ? 'selected' : ($property->status == 'Disponível' ? 'selected' : '') }}>
                                                Disponível
                                            </option>
                                            <option
                                                {{ old('status') == 'Indisponível' ? 'selected' : ($property->status == 'Indisponível' ? 'selected' : '') }}>
                                                Indisponível
                                            </option>
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pr-md-2">
                                        <label for="sale_price">Valor de Venda</label>
                                        <input type="text" class="form-control money_format_2" id="sale_price"
                                            placeholder="R$" name="sale_price"
                                            value="{{ old('sale_price') ?? $property->sale_price }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="rent_price">Valor de Locação</label>
                                        <input type="text" class="form-control money_format_2" id="rent_price"
                                            placeholder="R$" name="rent_price"
                                            value="{{ old('rent_price') ?? $property->rent_price }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pl-md-2">
                                        <label for="condominium">Valor de Condomínio</label>
                                        <input type="text" class="form-control money_format_2" id="condominium"
                                            placeholder="R$" name="condominium"
                                            value="{{ old('condominium') ?? $property->condominium }}">
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <label for="owner">Proprietário</label>
                                        <x-adminlte-select2 name="owner" id="owner">
                                            <option
                                                {{ old('owner') == '' ? 'selected' : ($property->owner == '' ? 'selected' : '') }}
                                                value="">Não
                                                Informado
                                            </option>
                                            @foreach ($clients as $client)
                                                <option
                                                    {{ old('owner') == $client->id ? 'selected' : ($property->owner == $client->id ? 'selected' : '') }}
                                                    value="{{ $client->id }}">
                                                    {{ $client->name . ' ' . ($client->document_person ? '- CPF: ' . $client->document_person : '') }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <label for="client_id">Cliente</label>
                                        <x-adminlte-select2 name="client_id" id="client_id">
                                            <option
                                                {{ old('client_id') == '' ? 'selected' : ($property->client_id == '' ? 'selected' : '') }}
                                                value="">Não
                                                Informado</option>
                                            @foreach ($clients as $client)
                                                <option
                                                    {{ old('client_id') == $client->id ? 'selected' : ($property->client_id == $client->id ? 'selected' : '') }}
                                                    value="{{ $client->id }}">
                                                    {{ $client->name . ' ' . ($client->document_person ? '- CPF: ' . $client->document_person : '') }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <label for="agency_id">Agência</label>
                                        <x-adminlte-select2 name="agency_id" id="agency_id">
                                            <option
                                                {{ old('agency_id') == '' ? 'selected' : ($property->agency_id == '' ? 'selected' : '') }}
                                                value="">Não
                                                Informada</option>
                                            @foreach ($agencies as $agency)
                                                <option
                                                    {{ old('agency_id') == $agency->id ? 'selected' : ($property->agency_id == $agency->id ? 'selected' : '') }}
                                                    value="{{ $agency->id }}">
                                                    {{ $agency->alias_name . ' ' . ($agency->document_company ? '- CNPJ: ' . $agency->document_company : '') }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    @php
                                        $config = [
                                            'height' => '100',
                                            'toolbar' => [
                                                // [groupName, [list of button]]
                                                ['style', ['style']],
                                                ['font', ['bold', 'underline', 'clear']],
                                                ['fontsize', ['fontsize']],
                                                ['fontname', ['fontname']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['height', ['height']],
                                                ['table', ['table']],
                                                ['insert', ['link', 'picture', 'video']],
                                                ['view', ['fullscreen', 'codeview', 'help']],
                                            ],
                                            'inheritPlaceholder' => true,
                                        ];
                                    @endphp

                                    <div class="col-12 cform-group px-0">
                                        <x-adminlte-text-editor name="description" label="Descrição"
                                            label-class="text-black" igroup-size="md" placeholder="Texto descritivo..."
                                            :config="$config">
                                            {!! old('description') ?? $property->description !!}
                                        </x-adminlte-text-editor>
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <label for="instagram">Vídeo de apresentação do Youtube</label>
                                        <input type="url" class="form-control" id="video"
                                            placeholder="https://www.youtube.com/watch?v=..." name="video"
                                            value="{{ old('video') ?? $property->video }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pr-md-2">
                                        <label for="rooms">Salas</label>
                                        <input type="number" step="1" class="form-control" id="rooms"
                                            placeholder="Qtd" name="rooms"
                                            value="{{ old('rooms') ?? $property->rooms }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="bedrooms">Quartos</label>
                                        <input type="number" step="1" class="form-control" id="bedrooms"
                                            placeholder="Qtd" name="bedrooms"
                                            value="{{ old('bedrooms') ?? $property->bedrooms }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="bathrooms">Banheiros</label>
                                        <input type="number" step="1" class="form-control" id="bathrooms"
                                            placeholder="Qtd" name="bathrooms"
                                            value="{{ old('bathrooms') ?? $property->bathrooms }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pl-md-2">
                                        <label for="suites">Suites</label>
                                        <input type="number" step="1" class="form-control" id="suites"
                                            placeholder="Qtd" name="suites"
                                            value="{{ old('suites') ?? $property->suites }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pr-md-2">
                                        <label for="garage">Garagens</label>
                                        <input type="number" step="1" class="form-control" id="garage"
                                            placeholder="Qtd" name="garage"
                                            value="{{ old('garage') ?? $property->garage }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="garage_covered">Garagens Cobertas</label>
                                        <input type="number" step="1" class="form-control" id="garage_covered"
                                            placeholder="Qtd" name="garage_covered"
                                            value="{{ old('garage_covered') ?? $property->garage_covered }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="area_util">Área Útil (m<sup>2</sup>)</label>
                                        <input type="number" step="0.1" class="form-control" id="area_util"
                                            placeholder="m2" name="area_util"
                                            value="{{ old('area_util') ?? $property->area_util }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pl-md-2">
                                        <label for="area_total">Área Total (m<sup>2</sup>)</label>
                                        <input type="number" step="0.1" class="form-control" id="area_total"
                                            placeholder="m2" name="area_total"
                                            value="{{ old('area_total') ?? $property->area_total }}">
                                    </div>

                                    <div class="col-12 px-0">
                                        <label for="differentials">Diferenciais</label>
                                        <div class="d-flex flex-wrap justify-content-start">
                                            @foreach ($differentials as $differential)
                                                <div class="col-12 col-md-4">
                                                    <div class="card p-0">
                                                        <div class="card-body icheck-primary">
                                                            <input type="checkbox"
                                                                name="differential_{{ $differential->id }}"
                                                                id="differential_{{ $differential->id }}"
                                                                {{ in_array($differential->id, $property->differentials->pluck('differential_id')->toArray()) ? 'checked' : '' }}>
                                                            <label for="differential_{{ $differential->id }}"
                                                                class="my-0 ml-2">{{ $differential->name }}</label>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @php
                                        $configResumeDifferentials = [
                                            'height' => '100',
                                            'toolbar' => []
                                        ];
                                    @endphp

                                    <div class="col-12 px-0">
                                        <x-adminlte-text-editor name="differentials_resume"
                                            label="Resumo dos diferenciais" id="differentials_resume" igroup-size="sm"
                                            placeholder="Texto para apresentação na landing page referente aos diferenciais...."
                                            :config="$configResumeDifferentials">
                                            {{ old('differentials_resume') ?? $property->differentials_resume }}
                                        </x-adminlte-text-editor>
                                    </div>

                                    <h3 class="h6 col-12 px-0 mt-2 text-bold">Endereço</h3>

                                    <div class="col-12 col-md-4 form-group px-0 pr-md-2">
                                        <label for="zipcode">CEP</label>
                                        <input type="tel" class="form-control" id="zipcode" placeholder="CEP"
                                            name="zipcode" value="{{ old('zipcode') ?? $property->zipcode }}">
                                    </div>
                                    <div class="col-12 col-md-8 form-group px-0 pl-md-2">
                                        <label for="street">Rua</label>
                                        <input type="text" class="form-control" id="street" placeholder="Rua"
                                            name="street" value="{{ old('street') ?? $property->street }}">
                                    </div>

                                    <div class="col-12 col-md-4 form-group px-0 pr-md-2">
                                        <label for="number">Número</label>
                                        <input type="text" class="form-control" id="number" placeholder="Número"
                                            name="number" value="{{ old('number') ?? $property->number }}">
                                    </div>
                                    <div class="col-12 col-md-8 form-group px-0 pl-md-2">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="form-control" id="complement"
                                            placeholder="Complemento" name="complement"
                                            value="{{ old('complement') ?? $property->complement }}">
                                    </div>

                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="neighborhood">Bairro</label>
                                        <input type="text" class="form-control" id="neighborhood"
                                            placeholder="Bairro" name="neighborhood"
                                            value="{{ old('neighborhood') ?? $property->neighborhood }}">
                                    </div>
                                    <div class="col-12 col-md-4 form-group px-0 px-md-2">
                                        <label for="city">Cidade</label>
                                        <input type="text" class="form-control" id="city" placeholder="Cidade"
                                            name="city" value="{{ old('city') ?? $property->city }}">
                                    </div>

                                    <div class="col-12 col-md-2 form-group px-0 pl-md-2">
                                        <label for="state">Estado</label>
                                        <input type="text" class="form-control" id="state" placeholder="UF"
                                            name="state" value="{{ old('state') ?? $property->state }}">
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <x-adminlte-input-file id="images" name="images[]"
                                            label="Imagens da Propriedade 860 x 490" placeholder="Selecione múltiplos..."
                                            igroup-size="md" legend="Selecione" multiple>
                                        </x-adminlte-input-file>
                                    </div>

                                    @if ($property->images->count() > 0)
                                        <div class="col-12 form-group px-0 d-flex flex-wrap justify-content-start"
                                            id="property-images" data-id={{ $property->id }}
                                            data-url="{{ route('admin.properties.images-order') }}">
                                            @foreach ($property->images as $image)
                                                <div class="col-12 col-md-3 p-2 card">
                                                    <div class="card-body d-flex justify-content-center align-items-center draggable-area"
                                                        data-position="{{ $image->order }}">
                                                        <img class="img-fluid draggable-item"
                                                            src="{{ asset('storage/properties/album/' . $image->location) }}"
                                                            alt="" data-order="{{ $image->order }}">
                                                    </div>
                                                    <div
                                                        class="card-footer
                                                            d-flex justify-content-center">
                                                        <button class="btn btn-sm btn-danger image-delete"
                                                            data-id={{ $image->id }} data-property={{ $property->id }}
                                                            data-action="{{ route('admin.properties.image-delete') }}"><i
                                                                class="fa fa-trash"></i>Excluir</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <h3 class="h6 col-12 px-0 mt-2 text-bold text-center">Campanha</h3>

                                    <div class="col-12 form-group px-0">
                                        <x-adminlte-textarea name="header_pixel" label="Pixel do Cabeçalho" rows=5
                                            igroup-size="sm"
                                            placeholder="Cole o píxel do cabeçalho aqui">{{ old('header_pixel') ?? $property->header_pixel }}
                                        </x-adminlte-textarea>
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <x-adminlte-textarea name="body_pixel" label="Pixel do Corpo" rows=5
                                            igroup-size="sm"
                                            placeholder="Cole o píxel do corpo aqui">{{ old('body_pixel') ?? $property->body_pixel }}
                                        </x-adminlte-textarea>
                                    </div>                             

                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="template">Template</label>
                                        <x-adminlte-select2 name="template" id="template">
                                            <option
                                                {{ old('template') == '' ? 'selected' : ($property->template == 'default' ? 'selected' : '') }}
                                                value="default">Padrão
                                            </option>
                                        </x-adminlte-select2>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom_js')
    <script src="{{ asset('vendor/jquery/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('js/money.js') }}"></script>
    <script src="{{ asset('js/address.js') }}"></script>
    <script src="{{ asset('js/image-delete.js') }}"></script>
    <script src="{{ asset('js/image-order.js') }}"></script>
@endsection
