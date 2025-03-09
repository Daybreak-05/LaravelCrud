@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="display-4 text-danger">Error 417</h1>
    <p class="lead">El servidor se esperaba otra cosa.</p>
    <img src="https://media1.tenor.com/m/320Sgw0PYAwAAAAC/computer-crash-furious.gif" alt="Error 417" class="img-fluid my-4" style="max-width: 400px;">
    <p>Por favor, vuelve al inicio o contacta con Picón.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Volver al Inicio</a>
</div>
@endsection
