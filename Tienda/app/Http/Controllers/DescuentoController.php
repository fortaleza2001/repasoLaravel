<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descuento;

class DescuentoController extends Controller
{
    // Listar todos los descuentos
    public function index()
    {
        $descuentos = Descuento::all();
        return view('vista_gestionar_descuentos', ['descuentos' => $descuentos] );
    }

    public function create()
    {
        return view('vista_crear_descuento');
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|min:0|max:100',
            'fecha_finalizacion' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);
    
        try {
            $descuento = Descuento::create($request->only(['nombre', 'porcentaje', 'fecha_finalizacion', 'descripcion']));
            return redirect()->route('descuentos.index')->with('success', 'Descuento creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('descuentos.index')->with('error', 'Error al crear el descuento: ' . $e->getMessage());
        }
    }
    
    public function update(Request $request, $id)
    {
        // Buscar el descuento por ID
        $descuento = Descuento::findOrFail($id);
    

        // Actualizar los atributos del descuento
        $descuento->nombre = $request->input('nombre');
        $descuento->porcentaje = $request->input('porcentaje');
        $descuento->fecha_finalizacion = $request->input('fecha_finalizacion');
        $descuento->descripcion = $request->input('descripcion');
    
        // Guardar los cambios
        $descuento->save();
    
        // Redirigir a la lista de descuentos con un mensaje de éxito
        return redirect()->route('descuentos.index')->with('success', 'Descuento actualizado correctamente.');
    }

    public function edit($id)
    {
     
            // Busca el descuento por ID
            $descuento = Descuento::findOrFail($id);
        
            // Devuelve la vista de editar descuento con el descuento encontrado
            return view('vista_editar_descuento', compact('descuento'));
        
        
    }

    public function destroy($id)
    {
        $descuento = Descuento::findOrFail($id); // Busca el producto por ID

        $descuento->delete(); // Elimina el producto

        return redirect()->route('descuentos.index')->with('success', 'Descuento eliminado correctamente.');
    }
    
}
