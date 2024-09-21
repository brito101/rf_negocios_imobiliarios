@extends('adminlte::master')
@section('title', '- 404 | Oops! Página não encontrada')

@section('body')
    <canvas class="snow"></canvas>
    <div class="error-area d-flex justify-content-center align-content-center pt-5">
        <div class="d-table">
            <div class="d-table-cell pt-5">
                <div class="error-content text-center">
                    <img src="{{ asset('img/404-error.webp') }}" alt="Image" class="w-75">
                    <h3 class="text-dark">Oops! Página não encontrada</h3>
                    <p class="text-muted">A página que você está procurando pode ter sido removida teve seu nome alterado
                        ou está
                        temporariamente indisponível.</p>
                    <a href="{{ route('admin.home') }}" class="btn btn-lg btn-primary">
                        Retornar à página inicial
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('js/snow.js') }}"></script>
@endsection
