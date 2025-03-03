<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>
        
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" value="{{ $usuario->usuario }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" value="{{ $usuario->email }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">Nueva Contraseña (opcional)</label>
                <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded">
            </div>
            
            <div>
                <label class="block text-gray-700">Rol</label>
                <select name="rol" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="usuario" {{ $usuario->rol == 'usuario' ? 'selected' : '' }}>Usuario</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Dirección</label>
                <select name="direccion_id" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">Seleccione una dirección</option>
                    @foreach($direcciones as $direccion)
                        <option value="{{ $direccion->id }}" {{ $usuario->direccion_id == $direccion->id ? 'selected' : '' }}>
                            {{ $direccion->calle }}, {{ $direccion->ciudad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Imagen de Perfil</label>
                <input type="file" name="imagen_perfil" id="imagen_perfil" accept="image/*" class="w-full p-2 border border-gray-300 rounded" onchange="previewImage(event)">
                <img id="preview" 
                     class="mt-2 w-32 h-32 object-cover rounded {{ !empty($usuario->imagen_usuario) && file_exists(public_path('imagenes/' . $usuario->imagen_usuario)) ? '' : 'hidden' }}" 
                     src="{{ !empty($usuario->imagen_usuario) && file_exists(public_path('imagenes/' . $usuario->imagen_usuario)) ? asset('imagenes/' . $usuario->imagen_usuario) : '' }}" 
                     alt="Imagen de Perfil">
            </div>
            
            
            <div class="flex justify-between">
                <a href="{{ route('usuarios.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Volver</a>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Actualizar Usuario</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
