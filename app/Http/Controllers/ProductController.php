<?php 

// Si no se crea el enlace simbólico, se puede hacer con el comando en la terminal
//php artisan storage:link


// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{

public function index(Request $request)
{
    $query = Product::query();

    // Filtro por nombre del producto
    if ($request->has('name') && $request->name != '') {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Filtro por precio
    if ($request->has('min_price') && $request->min_price != '') {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->has('max_price') && $request->max_price != '') {
        $query->where('price', '<=', $request->max_price);
    }

    // Filtro por categoría
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


    public function create()
    {
        return view('products.create');
    }

    // Almacenar un producto
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
        $product->image = $imagePath;
        $product->user_id = auth()->id();
        $product->save();


        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    // Mostrar los detalles de un producto
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

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


    public function markAsPending(Product $product) {
        if (Auth::id() === $product->user_id) {
            return redirect()->back()->with('error', 'No puedes marcar tu propio producto como pendiente de compra.');
        }
    
        $product->interested_user_id = Auth::id();
        $product->save();
    
        return redirect()->back()->with('success', 'Has marcado este producto como pendiente de compra.');
    }
    
}
?>