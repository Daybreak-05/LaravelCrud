@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-primary">Nuevo Producto</a>
</div>
    <div class="container">
        <div class="row justify-content-between mb-3">
            <div class="col-md-6">
                <h1>Productos</h1>
            </div>
            <div class="col-md-6 text-end">
                <!-- Formulario para seleccionar el número de productos por página -->
                
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Enlaces de paginación -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
