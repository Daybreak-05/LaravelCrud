@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Sobre Nosotros</h1>
    <p>En <strong>Pik Shop</strong> puedes encontrar los mejores productos y ofertas.</p>
    <p>En nuestra tienda en línea, puedes encontrar una gran variedad de productos que los usuarios revenden, desde ropa y accesorios hasta electrónicos y productos para el hogar.</p>

    <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
    <p>Si tienes preguntas, visita nuestra <a href="{{ route('contact') }}">página de contacto</a>.</p>
</div>
@endsection
