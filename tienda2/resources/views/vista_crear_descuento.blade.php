<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ session('idioma', 'es') == 'es' ? 'Crear Descuento' : 'Create Discount' }}
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">
            {{ session('idioma', 'es') == 'es' ? 'Crear Nuevo Descuento' : 'Create New Discount' }}
        </h1>
        
        <form action="{{ route('descuentos.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Nombre' : 'Name' }}
                </label>
                <input type="text" name="nombre" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Porcentaje' : 'Percentage' }}
                </label>
                <input type="number" name="porcentaje" step="0.01" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Fecha de Finalización' : 'End Date' }}
                </label>
                <input type="date" name="fecha_finalizacion" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Descripción' : 'Description' }}
                </label>
                <textarea name="descripcion" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('descuentos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                    {{ session('idioma', 'es') == 'es' ? 'Volver' : 'Back' }}
                </a>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                    {{ session('idioma', 'es') == 'es' ? 'Guardar Descuento' : 'Save Discount' }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>
