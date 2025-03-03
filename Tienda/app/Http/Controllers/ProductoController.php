<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Descuento;
use Illuminate\Http\Request;


class ProductoController extends Controller
{
    // Ruta para listar todos los productos
    public function index()
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all(); // Corrección en el nombre de la variable
        $descuentos = Descuento::all(); // Corrección en el nombre de la variable
    
        return view('vista_gestionar_productos', [
            'productos' => $productos,
            'proveedores' => $proveedores,
            'descuentos' => $descuentos
        ]);
    }
    

    public function home()
    {
        $productos = Producto::all();
        return view('home', ['productos' => $productos]); // Corrige el cierre de la función
    }

    public function detalle($id)
    {
        $producto = Producto::findOrFail($id); // Busca el producto por ID
        $proveedores = Proveedor::all(); // Obtiene la lista de proveedores
        $descuentos = Descuento::all(); // Obtiene la lista de descuentos

        return view('detalle', compact('producto', 'proveedores', 'descuentos'));
    }



    public function edit($id)
    {
        $producto = Producto::findOrFail($id); // Busca el producto por ID
        $proveedores = Proveedor::all(); // Obtiene la lista de proveedores
        $descuentos = Descuento::all(); // Obtiene la lista de descuentos

        return view('vista_editar_producto', compact('producto', 'proveedores', 'descuentos'));
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id); // Busca el producto por ID

        $producto->delete(); // Elimina el producto

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }




    // Ruta para filtrar productos por nombre

    // Ruta para ordenar productos por precio
    public function ordenarPorPrecio(Request $request)
    {
        $ordenPrecio = $request->input('orden_precio', 'asc');
        $productos = Producto::orderBy('precio', $ordenPrecio)->get();
        return response()->json($productos);
    }

    // Ruta para filtrar por proveedor
    public function filtrarPorProveedor(Request $request)
    {
        $proveedorId = $request->input('proveedor_id');
        $productos = Producto::where('proveedor_id', $proveedorId)->get();
        return response()->json($productos);
    }

    // Ruta para almacenar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedores,id',
            'descuento_id' => 'nullable|exists:descuento,id',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
            'imagen_producto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Crear un nuevo producto
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->proveedor_id = $request->input('proveedor_id');
        $producto->descuento_id = $request->input('descuento_id');
        $producto->descripcion = $request->input('descripcion');
        $producto->cantidad = $request->input('cantidad');
    
        // Manejo de la imagen
        if ($request->hasFile('imagen_producto')) {
            $imagen = $request->file('imagen_producto');
            $nombreArchivo = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $imagen->getClientOriginalExtension();
    
            // Verificar si el archivo ya existe y agregar un carácter aleatorio si es necesario
            while (Storage::disk('public')->exists("{$nombreArchivo}.{$extension}")) {
                $caracterAleatorio = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 1);
                $nombreArchivo .= $caracterAleatorio;
            }
    
            // Guardar la imagen en la carpeta "public"
            $ruta = $imagen->storeAs("", "{$nombreArchivo}.{$extension}", "public");
    
            // Guardar el nombre del archivo en el producto
            $producto->imagen_producto = "{$nombreArchivo}.{$extension}";
        }
    
        // Guardar el producto en la base de datos
        $producto->save();
    
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id); // Busca el producto por ID
    
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedores,id',
            'descuento_id' => 'nullable|exists:descuento,id',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
            'imagen_producto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->proveedor_id = $request->input('proveedor_id');
        $producto->descuento_id = $request->input('descuento_id');
        $producto->descripcion = $request->input('descripcion');
        $producto->cantidad = $request->input('cantidad');
    
        if ($request->hasFile('imagen_producto')) {
            $imagen = $request->file('imagen_producto');
            $nombreArchivo = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $imagen->getClientOriginalExtension();
    
            while (Storage::disk('public')->exists("{$nombreArchivo}.{$extension}")) {
                // Generamos un carácter aleatorio
                $caracterAleatorio = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 1);
                
                // Añadimos el carácter aleatorio al nombre del archivo
                $nombreArchivo = $nombreArchivo . $caracterAleatorio;
            }
            $ruta = $imagen->storeAs("", "{$nombreArchivo}.{$extension}", "public");
    
            // Guardar el nuevo nombre en el producto
            $producto->imagen_producto = "{$nombreArchivo}.{$extension}";
        }
    
        $producto->save(); // Guarda los cambios
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }
    

    public function crearProductoVista()
{
    $descuentos = Descuento::all();
    $proveedores = Proveedor::all();
    
    return view('vista_crear_producto', compact('descuentos', 'proveedores'));
}

    
}
