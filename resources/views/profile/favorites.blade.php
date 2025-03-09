@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ Auth::user()->name }}'s Favoritos</h1>

        @if ($favorites->isEmpty())
            <p>No tienes productos favoritos.</p>
        @else
            <div class="row">
                @foreach ($favorites as $favorite)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $favorite->image) }}" class="card-img-top" alt="{{ $favorite->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $favorite->name }}</h5>
                                <p class="card-text">{{ $favorite->description }}</p>
                                <a href="{{ route('products.show', $favorite->id) }}" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $favorites->links() }}
            </div>
        @endif
    </div>
@endsection
