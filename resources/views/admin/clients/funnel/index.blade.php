@extends('adminlte::page')
@section('plugins.select2', true)
@section('plugins.BsCustomFileInput', true)

@section('title', '- Funil')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-fw fa-filter"></i> Funil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clientes</a></li>
                        <li class="breadcrumb-item active">Funil</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-0 px-md-2">
        @include('components.alert')
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="row d-flex flex-nowrap px-2 h-100 pt-2" style="overflow-x: auto" id="kanban"
                    data-action="{{ route('admin.clients.updateKanban') }}">

                    @foreach ($steps as $step)
                        <div class="col-12 col-md-3 p-2">
                            <div class="card card-row card-light" style="border: 2px solid {{ $step->color }}">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $step->name }}<span class="ml-2 badge badge-pill badge-dark count"></span>
                                    </h3>
                                </div>
                                <div class="card-body draggable-area" data-step="{{ $step->id }}"
                                    style="background-color: {{ $step->color }}">
                                    @foreach ($clients as $client)
                                        @if ($client->step_id == $step->id)
                                            @include('admin.clients.funnel.components.kanban-card', [
                                                'client' => $client,
                                            ])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection

@section('custom_js')
    <script src={{ asset('js/kanban.js') }}></script>
@endsection
