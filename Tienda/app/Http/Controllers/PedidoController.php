<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Descuento;
use App\Models\PedidoProducto;
use App\Models\Pedido;
use Illuminate\Http\Request;


class PedidoController extends Controller
{
   

    public function index()
    {
        $pedidos = Pedido::where('usuario_id', auth()->id())->get();
        return view('pedidos', ['pedidos' => $pedidos]);
    }
    
    public function gestion()
    {
        // Obtener todos los pedidos con información del usuario
        $pedidos = Pedido::all();

        // Retornar la vista con los pedidos
        return view('vista_gestionar_pedidos', compact('pedidos'));
    }



    public function show($id)
{
    // Buscar el pedido con sus líneas de productos
    $pedido = Pedido::findOrFail($id);
    
    // Obtener las líneas del pedido con información del producto
    $lineas = PedidoProducto::where('pedido_id', $id)
                ->with('producto') // Relación con el modelo Producto
                ->get();

    // Pasar los datos a la vista
    return view('pedidoDetalle', compact('pedido', 'lineas'));
}



    public function añadirProductoPedidoActual(Request $request)
{
    $request->validate([
        'producto_id' => 'required|integer|exists:productos,id',
        'cantidad' => 'required|integer|min:1'
    ]);

    // Obtener el usuario autenticado
    $usuarioId = auth()->id(); 

    // Obtener el producto de la base de datos
    $producto = Producto::find($request->producto_id);

    // Si no existe la sesión 'pedido', la inicializa como un array vacío
    if (!session()->has('pedido')) {
        session(['pedido' => []]);
    }

    // Obtener el pedido actual desde la sesión
    $pedido = session('pedido');

    // Agregar el nuevo producto al pedido con su precio
    $pedido[] = [
        'producto_id' => $producto->id,
        'nombre' => $producto->nombre,
        'usuario_id' => $usuarioId,
        'cantidad' => $request->cantidad,
        'precio' => $producto->precio, // Agregar el precio del producto
    ];

    

    // Guardar el pedido actualizado en la sesión
    session(['pedido' => $pedido]);

    return redirect()->route('productos.home')->with('success', 'Producto añadido al pedido actual.');
}


public function crearPedido()
{
    // Verificar si hay un pedido en la sesión
    if (!session()->has('pedido') || empty(session('pedido'))) {
        return back()->with('error', 'No hay ningún pedido en curso.');
    }


// Obtener los productos del pedido desde la sesión
    $productos = session('pedido');

    // Calcular el total del pedido
    $totalPedido = 0;
    foreach ($productos as $producto) {
        $totalPedido += $producto['cantidad'] * $producto['precio'];
    }

    $pedido = Pedido::create([
        'usuario_id' => auth()->id(), // Asignar el usuario autenticado
        'fecha_compra' => now(), // Fecha de compra en el momento actual
        'fecha_aproximada_entrega' => now()->addDays(2), // Fecha de entrega en 2 días
    ]);

    foreach ($productos as $producto) {
        PedidoProducto::create([
            'pedido_id' => $pedido->id,
            'producto_id' => $producto['producto_id'],
            'cantidad' => $producto['cantidad']
            
        ]);
    }

   
    // Eliminar la variable de sesión 'pedido'
    session()->forget('pedido');

    return back()->with('success', 'Pedido creado con éxito.');
}

public function destroy($id)
{
    $pedido = Pedido::findOrFail($id); // Busca el pedido por ID
    
    // Eliminar todas las líneas de producto asociadas a este pedido
    $pedido->productos()->delete();

    // Ahora eliminamos el pedido
    $pedido->delete();

    return redirect()->route('pedidos.gestion')->with('success', 'Pedido y sus productos eliminados correctamente.');
}





}
