<!-- resources/views/errors/500.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>¡Oops! Algo salió mal</h4>
                    </div>
                    <div class="card-body">
                        <p>Lo siento, pero algo salió mal en el servidor. Por favor, intenta nuevamente más tarde.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
