@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Verifica si el producto existe -->
        @if ($product)
            <div class="row">
                <div class="col-md-6">
                    <!-- Imagen del producto -->
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
    
                    @endif
                </div>
                <div class="col-md-6">
                    <!-- Información del producto -->
                    <h2>{{ $product->name }}</h2>
                    <p><strong>Descripción:</strong> {{ $product->description }}</p>
                    <p><strong>Precio:</strong> ${{ $product->price }}</p>
                    <p><strong>Publicado por:</strong> {{ $product->owner->name }}</p>


                    @if($product->interested_user_id)
                        <p><strong>Interesado en comprar:</strong> {{ $product->interestedUser->name }}</p>
                    @else
                        @auth
                            @if(Auth::id() !== $product->user_id)
                                <form action="{{ route('products.pending', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Marcar como pendiente de compra</button>
                                </form>
                            @endif
                        @endauth
                    @endif


            <!-- Botón para volver a la lista de productos -->
            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver a la lista de productos</a>
            </div>


            <h3>Comentarios</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @auth
                <form action="{{ route('comments.store', $product) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Escribe un comentario</label>
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Comentar</button>
                </form>
            @endauth

            <ul class="list-group mt-4">
                @foreach($product->comments as $comment)
                    <li class="list-group-item">
                        <strong>{{ $comment->user->name }}</strong> - {{ $comment->created_at->diffForHumans() }}
                        <p>{{ $comment->content }}</p>
                        
                        @if(Auth::id() === $comment->user_id)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>



        @else
            <p>Producto no encontrado.</p>
        @endif
    </div>
@endsection
