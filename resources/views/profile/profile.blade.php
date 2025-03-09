@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Perfil de {{ $user->name }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p><strong>Correo electrónico:</strong> {{ $user->email }}</p>
                    <p><strong>Fecha de creación:</strong> {{ $user->created_at->format('d-m-Y') }}</p>

                    <!-- Botón para editar el perfil -->
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
