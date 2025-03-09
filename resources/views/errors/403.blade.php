@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Acceso denegado</h4>
                    </div>
                    <div class="card-body">
                        <p>No tienes permisos para acceder a esta página.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
