<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ session('idioma', 'es') == 'es' ? 'Editar Descuento' : 'Edit Discount' }}
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">
            {{ session('idioma', 'es') == 'es' ? 'Editar Descuento' : 'Edit Discount' }}
        </h1>
        
        <form action="{{ route('descuentos.update', $descuento->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Nombre' : 'Name' }}
                </label>
                <input type="text" name="nombre" value="{{ $descuento->nombre }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Porcentaje' : 'Percentage' }}
                </label>
                <input type="number" name="porcentaje" value="{{ $descuento->porcentaje }}" step="0.01" class="w-full p-2 border border-gray-300 rounded" required min="0" max="100">
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Fecha de Finalización' : 'End Date' }}
                </label>
                <input type="date" name="fecha_finalizacion" value="{{ $descuento->fecha_finalizacion }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Descripción' : 'Description' }}
                </label>
                <textarea name="descripcion" class="w-full p-2 border border-gray-300 rounded">{{ $descuento->descripcion }}</textarea>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('descuentos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                    {{ session('idioma', 'es') == 'es' ? 'Volver' : 'Back' }}
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    {{ session('idioma', 'es') == 'es' ? 'Actualizar Descuento' : 'Update Discount' }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>
