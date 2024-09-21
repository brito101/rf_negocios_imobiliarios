@extends('adminlte::page')
@section('plugins.select2', true)
@section('plugins.BootstrapSelect', true)

@section('title', '- Edição de Tipo')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-fw fa-circle"></i> Editar Tipo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        @can('Listar Tipos')
                            <li class="breadcrumb-item"><a href="{{ route('admin.types.index') }}">Tipos</a></li>
                        @endcan
                        <li class="breadcrumb-item active">Editar Tipo</li>
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
                            <h3 class="card-title">Dados Cadastrais do Tipo</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.types.update', ['type' => $type->id]) }}">
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $type->id }}">
                            @csrf
                            <div class="card-body">

                                <div class="d-flex flex-wrap justify-content-between">
                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nome da categoria" name="name"
                                            value="{{ old('name') ?? $type->name }}" required>
                                    </div>

                                    <div class="col-12 col-md-6 form-group px-0 pl-md-2">
                                        <label for="category">Categoria</label>
                                        <x-adminlte-select2 name="category_id">
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ old('category_id') == $category->id ? 'selected' : ($type->category_id == $category->id ? 'selected' : '') }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </x-adminlte-select2>
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
