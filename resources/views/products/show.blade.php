@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <!-- Mostrar los detalles del producto -->
            <div class="card">
                <div class="card-header">
                    <h4>{{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Descripción:</strong> {{ $product->description }}</p>
                    <p><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                    
                    <!-- Si tienes más detalles o relaciones, puedes mostrarlo aquí -->
                    @if ($product->category)
                        <p><strong>Categoría:</strong> {{ $product->category->name }}</p>
                    @endif
                    
                    @if ($product->manufacturer)
                        <p><strong>Fabricante:</strong> {{ $product->manufacturer->name }}</p>
                    @endif

                    <!-- Imagen del producto (si tienes una columna 'image') -->
                    @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <p>No hay imagen disponible.</p>
                    @endif
                </div>
            </div>

            <!-- Botón para regresar -->
            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Regresar a la lista</a>
        </div>
    </div>
</div>
@endsection
