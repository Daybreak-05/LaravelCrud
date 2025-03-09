<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;


class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user(); 
        return view('profile.profile', compact('user')); 
    }
   

    // edición del perfil
    public function edit()
    {
        $user = Auth::user(); 
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user(); 

    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional
    ]);


    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Si se proporciona una nueva contraseña
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }


    $saved = $user->save(); 

    if ($saved) {
        return redirect()->route('profile.show')->with('success', 'Perfil actualizado correctamente.');
    } else {
        return back()->with('error', 'Hubo un problema al actualizar tu perfil.');
    }
}


public function showFavorites()
{

    $user = Auth::user();


    $favorites = $user->favorites()->paginate(5);

    // vista con los favoritos
    return view('profile.favorites', compact('favorites'));
}


}
