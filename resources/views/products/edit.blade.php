@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<h1>Editar Producto</h1>

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio</label>
        <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
