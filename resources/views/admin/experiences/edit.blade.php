@extends('adminlte::page')

@section('title', '- Edição de Experiência')
@section('plugins.BsCustomFileInput', true)

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-fw fa-cloud"></i> Editar Experiência</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        @can('Listar Experiências')
                            <li class="breadcrumb-item"><a href="{{ route('admin.experiences.index') }}">Experiências</a></li>
                        @endcan
                        <li class="breadcrumb-item active">Editar Experiência</li>
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
                            <h3 class="card-title">Dados Cadastrais da Experiência</h3>
                        </div>

                        <form method="POST"
                            action="{{ route('admin.experiences.update', ['experience' => $experience->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $experience->id }}">
                            <div class="card-body">

                                <div class="d-flex flex-wrap justify-content-between">
                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nome da experiência" name="name"
                                            value="{{ old('name') ?? $experience->name }}" required>
                                    </div>

                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2 d-flex flex-wrap mb-0">

                                        <div class="{{ $experience->cover != null ? 'col-md-9' : 'col-md-12' }} px-0">
                                            <x-adminlte-input-file name="cover" label="Foto"
                                                placeholder="Selecione uma imagem..." legend="Selecionar" />
                                        </div>

                                        @if ($experience->cover != null)
                                            <div
                                                class='col-12 col-md-3 align-self-center mt-3 d-flex justify-content-center justify-content-md-end px-0'>
                                                <img src="{{ $experience->cover }}" alt="{{ $experience->name }}"
                                                    style="max-width: 80%;" class="img-thumbnail d-block">
                                            </div>
                                        @endif
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
