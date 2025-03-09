<?php 
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Muestra la lista de roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Muestra el formulario de creación de roles
    public function create()
    {
        return view('roles.create');
    }

    // Almacena un nuevo rol en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles|max:50',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    // Muestra un rol en detalle
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    // Muestra el formulario de edición de un rol
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Actualiza un rol en la base de datos
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    // Elimina un rol
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}
?>