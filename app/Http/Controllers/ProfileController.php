<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;


class ProfileController extends Controller
{
    // Mostrar el perfil
    public function show()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('profile.profile', compact('user'));  // Cambié 'show' a 'profile'
    }
   

    // Mostrar el formulario de edición del perfil
    public function edit()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('profile.edit', compact('user'));
    }

    // Actualizar el perfil
    public function update(Request $request)
{
    $user = Auth::user(); // Obtener el usuario autenticado

    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional
    ]);

    // Actualizar los campos
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Si se proporciona una nueva contraseña, la actualizamos
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    // Guardamos los cambios en la base de datos
    $saved = $user->save(); 

    if ($saved) {
        return redirect()->route('profile.show')->with('success', 'Perfil actualizado correctamente.');
    } else {
        return back()->with('error', 'Hubo un problema al actualizar tu perfil.');
    }
}

// app/Http/Controllers/ProfileController.php

public function showFavorites()
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Obtener los productos favoritos del usuario (con paginación)
    $favorites = $user->favorites()->paginate(5);

    // Retornar la vista con los favoritos
    return view('profile.favorites', compact('favorites'));
}


}
