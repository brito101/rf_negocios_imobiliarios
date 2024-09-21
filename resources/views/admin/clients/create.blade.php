@extends('adminlte::page')
@section('plugins.Summernote', true)
@section('plugins.select2', true)

@section('title', '- Cadastro de Cliente')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-fw fa-user-plus"></i> Novo Cliente</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clientes</a></li>
                        <li class="breadcrumb-item active">Novo Cliente</li>
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
                            <h3 class="card-title">Dados Cadastrais do Cliente</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.clients.store') }}">
                            @csrf
                            <div class="card-body">

                                <div class="d-flex flex-wrap justify-content-start">
                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nome Completo" name="name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="document_person">CPF</label>
                                        <input type="text" class="form-control" id="document_person"
                                            placeholder="CPF do cliente" name="document_person"
                                            value="{{ old('document_person') }}">
                                    </div>
                                    <div class="col-12 col-md-3 form-group px-0 pl-md-2">
                                        <label for="document_registry">RG</label>
                                        <input type="text" class="form-control" id="document_registry"
                                            placeholder="RG do cliente" name="document_registry"
                                            value="{{ old('document_registry') }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pr-md-2">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="E-mail do cliente" name="email" value="{{ old('email') }}">
                                    </div>
                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" id="instagram"
                                            placeholder="Instagram do cliente" name="instagram"
                                            value="{{ old('instagram') }}">
                                    </div>
                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="telephone">Telefone</label>
                                        <input type="text" class="form-control" id="telephone"
                                            placeholder="Telefone do cliente" name="telephone"
                                            value="{{ old('telephone') }}">
                                    </div>
                                    <div class="col-12 col-md-3 form-group px-0 pl-md-2">
                                        <label for="cell">Celular</label>
                                        <input type="text" class="form-control" id="cell"
                                            placeholder="Celular do cliente" name="cell" value="{{ old('cell') }}">
                                    </div>

                                    <div class="col-12 col-md-4 form-group px-0 pr-md-2">
                                        <label for="zipcode">CEP</label>
                                        <input type="tel" class="form-control" id="zipcode" placeholder="CEP"
                                            name="zipcode" value="{{ old('zipcode') }}">
                                    </div>
                                    <div class="col-12 col-md-8 form-group px-0 pl-md-2">
                                        <label for="street">Rua</label>
                                        <input type="text" class="form-control" id="street" placeholder="Rua"
                                            name="street" value="{{ old('street') }}">
                                    </div>

                                    <div class="col-12 col-md-4 form-group px-0 pr-md-2">
                                        <label for="number">Número</label>
                                        <input type="text" class="form-control" id="number" placeholder="Número"
                                            name="number" value="{{ old('number') }}">
                                    </div>
                                    <div class="col-12 col-md-8 form-group px-0 pl-md-2">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="form-control" id="complement"
                                            placeholder="Complemento" name="complement" value="{{ old('complement') }}">
                                    </div>

                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="neighborhood">Bairro</label>
                                        <input type="text" class="form-control" id="neighborhood"
                                            placeholder="Bairro" name="neighborhood" value="{{ old('neighborhood') }}">
                                    </div>
                                    <div class="col-12 col-md-4 form-group px-0 px-md-2">
                                        <label for="city">Cidade</label>
                                        <input type="text" class="form-control" id="city" placeholder="Cidade"
                                            name="city" value="{{ old('city') }}">
                                    </div>
                                    <div class="col-12 col-md-2 form-group px-0 pl-md-2">
                                        <label for="state">Estado</label>
                                        <input type="text" class="form-control" id="state" placeholder="UF"
                                            name="state" value="{{ old('state') }}">
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <label for="company">Empresa</label>
                                        <input type="text" class="form-control" id="company"
                                            placeholder="Empresa do cliente" name="company"
                                            value="{{ old('company') }}">
                                    </div>

                                    <div class="col-12 col-md-4 form-group px-0 pr-md-2">
                                        <label for="step_id">Fase de Prospecção</label>
                                        <x-adminlte-select2 name="step_id">
                                            @foreach ($steps as $step)
                                                <option {{ old('step_id') == $step->id ? 'selected' : '' }}
                                                    value="{{ $step->id }}">{{ $step->name }}</option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-4 form-group px-0 px-md-2">
                                        <label for="meeting">Data de Reunião</label>
                                        <input type="date" class="form-control date" id="meeting" placeholder=""
                                            name="meeting" value="{{ old('meeting') }}">
                                    </div>

                                    <div class="col-12 col-md-4 form-group px-0 pl-md-2">
                                        <label for="agency_id">Agência</label>
                                        <x-adminlte-select2 name="agency_id">
                                            @foreach ($agencies as $agency)
                                                <option {{ old('agency_id') == $agency->id ? 'selected' : '' }}
                                                    value="{{ $agency->id }}">{{ $agency->alias_name }}</option>
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
                                                ['insert', ['link', 'picture']],
                                                ['view', ['fullscreen', 'codeview', 'help']],
                                            ],
                                            'inheritPlaceholder' => true,
                                        ];
                                    @endphp


                                    <div class="col-12 form-group px-0 mb-0">
                                        <x-adminlte-text-editor name="observations" label="Observações"
                                            label-class="text-black" igroup-size="md" placeholder="Texto descritivo..."
                                            :config="$config">
                                            {!! old('observations') !!}
                                        </x-adminlte-text-editor>
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
    <script src="{{ asset('js/address.js') }}"></script>
    <script src="{{ asset('js/phone.js') }}"></script>
    <script src="{{ asset('js/document-person.js') }}"></script>
@endsection
