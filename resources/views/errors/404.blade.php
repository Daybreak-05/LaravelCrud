<!-- resources/views/errors/404.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>¡Vaya! Página no encontrada</h4>
                    </div>
                    <div class="card-body">
                        <p>La página que buscas no existe o ha sido movida. Asegúrate de que la URL esté correcta.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">¡LLévame de vuelta!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
