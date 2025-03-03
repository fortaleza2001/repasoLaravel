<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\Direccion;



class UsuarioController extends Controller
{
    
   

    public function index()
    {
        $usuarios =  Usuario::all();
        return view('vista_gestionar_usuarios', ['usuarios' => $usuarios] );
    }


    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id); // Busca el producto por ID

        $usuario->pedidos()->delete();
        $usuario->delete(); // Elimina el producto

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }


    public function create()
    {
        $direcciones = Direccion::all(); // Asegúrate de que tienes un modelo Direccion
        return view('vista_crear_usuarios', compact('direcciones'));
    }


    public function subirImagen(Request $request)
    {
        $request->validate([
            'imagen_usuario' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Obtener el usuario autenticado
        $usuario = auth()->user();
  

        $imagen = $request->file('imagen_usuario');
        $nombreArchivo = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME); // Nombre sin extensión
        $extension = $imagen->getClientOriginalExtension(); // Extensión original
        
        // Verificamos si el archivo ya existe y generamos un nuevo nombre si es necesario
        while (Storage::disk('public')->exists("{$nombreArchivo}.{$extension}")) {
            // Generamos un carácter aleatorio
            $caracterAleatorio = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 1);
            
            // Añadimos el carácter aleatorio al nombre del archivo
            $nombreArchivo = $nombreArchivo . $caracterAleatorio;
        }

        $ruta = $imagen->storeAs("", "{$nombreArchivo}.{$extension}", "public");
      
        $usuario->imagen_usuario = "{$nombreArchivo}.{$extension}";
        $usuario->save(); 

        return back()->with('success', 'Imagen subida correctamente.');
    }


    public function quitarImagen()
    {
      
        // Obtener el usuario autenticado
        $usuario = auth()->user();
  

        
        
      
        $usuario->imagen_usuario = null;

        $usuario->save(); 

        return back()->with('success', 'Imagen eliminada correctamente.');
    }


    public function store(Request $request)
{
    $ruta = null; // Variable para almacenar la ruta de la imagen si se sube
    $nombreArchivo = null; // Inicializamos la variable para evitar errores
    $extension = null; // También inicializamos la extensión

    if ($request->hasFile('imagen_perfil')) {
        $imagen = $request->file('imagen_perfil');
        $nombreArchivo = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME); // Nombre sin extensión
        $extension = $imagen->getClientOriginalExtension(); // Extensión original

        // Verificamos si el archivo ya existe y generamos un nuevo nombre si es necesario
        while (Storage::disk('public')->exists("{$nombreArchivo}.{$extension}")) {
            // Generamos un carácter aleatorio
            $caracterAleatorio = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 1);
            $nombreArchivo .= $caracterAleatorio;
        }

        $ruta = $imagen->storeAs("", "{$nombreArchivo}.{$extension}", "public");
    }

    // Crear el usuario
    $usuario = Usuario::create([
        'usuario' => $request->nombre,
        'email' => $request->email,
        'password' => bcrypt($request->password), // Se encripta la contraseña
        'rol' => $request->rol,
        'direccion_id' => $request->direccion_id,
        'imagen_usuario' => $nombreArchivo && $extension ? "{$nombreArchivo}.{$extension}" : null, // Si hay imagen, la guarda, si no, queda NULL
    ]);

    return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
}

    

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id); // Buscar el usuario por ID
        $direcciones = Direccion::all(); // Obtener todas las direcciones (si es necesario)
    
        return view('vista_editar_usuarios', compact('usuario', 'direcciones'));
    }
    


    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id); // Buscar el usuario por ID
        $nombreArchivo = null;
        $extension = null;
        
    
        if ($request->hasFile('imagen_perfil')) {
            $imagen = $request->file('imagen_perfil');
            $nombreArchivo = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $imagen->getClientOriginalExtension();
    
            // Generar un nuevo nombre si el archivo ya existe
            while (Storage::disk('public')->exists("{$nombreArchivo}.{$extension}")) {
                $caracterAleatorio = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 1);
                $nombreArchivo .= $caracterAleatorio;
            }
    
            // Eliminar la imagen anterior si existe
            if ($usuario->imagen_perfil && Storage::disk('public')->exists($usuario->imagen_perfil)) {
                Storage::disk('public')->delete($usuario->imagen_perfil);
            }
    
            // Guardar la nueva imagen
            $ruta = $imagen->storeAs("", "{$nombreArchivo}.{$extension}", "public");
        }
    
        // Actualizar los datos del usuario
        $usuario->update([
            'usuario' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $usuario->password,
            'rol' => $request->rol,
            'direccion_id' => $request->direccion_id,
            'imagen_usuario' => "{$nombreArchivo}.{$extension}",
        ]);
    
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }
    
  

  


    public function admin()
    {
        return view('administracion'); 
    }
}
