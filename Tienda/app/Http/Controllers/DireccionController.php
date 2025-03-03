<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;

class DireccionController extends Controller
{
    // Listar todos los descuentos
    public function index()
    {
        $direcciones =  Direccion::all();
        return view('vista_gestionar_direcciones', ['direcciones' => $direcciones] );
    }


    public function destroy($id)
    {
        $direccion = Direccion::findOrFail($id); // Busca el producto por ID
        $direccion->delete(); // Elimina el producto

        return redirect()->route('direcciones.index')->with('success', 'Direccion eliminada correctamente.');
    }
   

    public function create()
{
   
    return view('vista_crear_direcciones');
}

public function store(Request $request)
{
    $request->validate([
        'pais' => 'required|string|max:100',
        'provincia' => 'required|string|max:100',
        'calle' => 'required|string|max:255',
        'codigo_postal' => 'required|string|max:20',
    ]);

    Direccion::create($request->all());

    return redirect()->route('direcciones.index')->with('success', 'Dirección creada correctamente.');
}

public function edit($id)
{
    $direccion = Direccion::findOrFail($id);
    return view('vista_editar_direcciones', compact('direccion'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'pais' => 'required|string|max:100',
        'provincia' => 'required|string|max:100',
        'calle' => 'required|string|max:255',
        'codigo_postal' => 'required|string|max:20',
    ]);

    $direccion = Direccion::findOrFail($id);
    $direccion->update($request->all());

    return redirect()->route('direcciones.index')->with('success', 'Dirección actualizada correctamente.');
}


}
