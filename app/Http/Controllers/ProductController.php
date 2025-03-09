<?php 
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    // Mostrar todos los productos
// app/Http/Controllers/ProductController.php

public function index(Request $request)
{
    $query = Product::query();

    // Filtro por nombre del producto
    if ($request->has('name') && $request->name != '') {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Filtro por precio (rango mínimo y máximo)
    if ($request->has('min_price') && $request->min_price != '') {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->has('max_price') && $request->max_price != '') {
        $query->where('price', '<=', $request->max_price);
    }

    // Filtro por categoría (si tienes una relación de categorías, lo agregarías aquí)
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }

    // Ordenar por precio o fecha
    if ($request->has('sort_by')) {
        $sortBy = $request->sort_by;
        $sortDirection = $request->has('sort_direction') ? $request->sort_direction : 'asc';
        
        if ($sortBy == 'price') {
            $query->orderBy('price', $sortDirection);
        } else if ($sortBy == 'created_at') {
            $query->orderBy('created_at', $sortDirection);
        }
    }

    // Paginación (5, 10 o todos los productos)
    $perPage = $request->has('per_page') ? $request->per_page : 10;
    $products = $query->paginate($perPage);

    return view('products.index', compact('products'));
}

    // Mostrar el formulario para crear un producto
    public function create()
    {
        return view('products.create');
    }

    // Almacenar un nuevo producto
    public function store(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',  // Validación para la imagen
        ]);

        // Subir la imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Crear el producto en la base de datos
        $product = new Product();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->image = $imagePath;  // Guardamos la ruta de la imagen
        $product->user_id = auth()->id();
        $product->save();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    // Mostrar los detalles de un producto
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // app/Http/Controllers/ProductController.php

// Marcar como favorito
public function addToFavorites($id)
{
    $user = Auth::user();
    $product = Product::find($id);

    // Verifica si el producto no está ya en los favoritos
    if ($product) {
        $user->favorites()->toggle($product->id);  // toggle añade o elimina el producto
        return redirect()->back()->with('success', 'Producto agregado a favoritos.');
    } else {
        return redirect()->back()->with('error', 'Producto no encontrado.');
    }
}

    // Quitar de favoritos
    public function removeFromFavorites($id)
    {
        $product = Product::findOrFail($id);
        auth()->user()->favoriteProducts()->detach($product); // Quitar el producto de los favoritos

        return redirect()->back()->with('success', 'Producto eliminado de tus favoritos.');
    }


}
?>