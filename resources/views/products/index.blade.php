<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listado de Productos</h1>

        <!-- Filtros y Ordenación -->
        <form method="GET" action="{{ route('products.index') }}">
            <div class="row mb-3">
                <!-- Filtro por nombre -->
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control" placeholder="Buscar por nombre" value="{{ request('name') }}">
                </div>
                
                <!-- Filtro por precio -->
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="Precio mínimo" value="{{ request('min_price') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="Precio máximo" value="{{ request('max_price') }}">
                </div>

                <!-- Ordenar por -->
                <div class="col-md-2">
                    <select name="sort_by" class="form-control">
                        <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Precio</option>
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Fecha</option>
                    </select>
                </div>

                <!-- Dirección de ordenamiento -->
                <div class="col-md-2">
                    <select name="sort_direction" class="form-control">
                        <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                        <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descendente</option>
                    </select>
                </div>

                <!-- Paginación -->
                <div class="col-md-2">
                    <select name="per_page" class="form-control">
                        <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5 por página</option>
                        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10 por página</option>
                        <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>Todos</option>
                    
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Lista de productos -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
