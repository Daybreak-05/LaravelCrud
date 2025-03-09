<?php 
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $products = Product::paginate(5);  // Puedes usar paginación si lo prefieres
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
}
?>