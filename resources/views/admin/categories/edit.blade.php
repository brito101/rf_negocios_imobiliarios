@extends('adminlte::page')

@section('title', '- Edição de Categoria')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-fw fa-tag"></i> Editar Categoria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        @can('Listar Categorias')
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
                        @endcan
                        <li class="breadcrumb-item active">Editar Categoria</li>
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
                            <h3 class="card-title">Dados Cadastrais da Categoria</h3>
                        </div>

                        <form method="POST"
                            action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <div class="card-body">

                                <div class="d-flex flex-wrap justify-content-between">
                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nome da categoria" name="name"
                                            value="{{ old('name') ?? $category->name }}" required>
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
