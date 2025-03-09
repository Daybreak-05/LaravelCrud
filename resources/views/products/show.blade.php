@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Verifica si el producto existe -->
        @if ($product)
            <div class="row">
                <div class="col-md-6">
                    <!-- Imagen del producto -->
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                </div>
                <div class="col-md-6">
                    <!-- Información del producto -->
                    <h2>{{ $product->name }}</h2>
                    <p><strong>Descripción:</strong> {{ $product->description }}</p>
                    <p><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>

                    <!-- Formulario para agregar a favoritos -->
                    @auth
                        <form action="{{ route('products.addToFavorites', $product->id) }}" method="POST">
                            @csrf
                            @if (Auth::user()->favorites->contains($product->id))
                            <button type="submit" class="btn btn-danger">
                                Eliminar de favoritos
                                @else
                                <button type="submit" class="btn btn-success">
                                    Agregar a favoritos
                                @endif
                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            <!-- Botón para volver a la lista de productos -->
            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver a la lista de productos</a>
            </div>

        @else
            <p>Producto no encontrado.</p>
        @endif
    </div>
@endsection
