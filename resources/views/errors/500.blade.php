<!-- resources/views/errors/500.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    
                    <img src="https://media1.tenor.com/m/mWFelILO6L8AAAAd/spongebob-squarepants-spongebob.gif" alt="">
                    <div class="card-header">
                        <h4>¡Caos en el servidor!</h4>
                    </div>
                    
                    <div class="card-body">
                        <p>Lo siento, pero algo salió mal en el servidor. Por favor, intentalo de nuevo o contacta con el Picón más cercano</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Volver a casa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
