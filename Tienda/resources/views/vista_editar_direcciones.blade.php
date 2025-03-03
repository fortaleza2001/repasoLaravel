<!DOCTYPE html>
<html lang="{{ session('idioma', 'es') == 'es' ? 'es' : 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ session('idioma', 'es') == 'es' ? 'Editar Dirección' : 'Edit Address' }}
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">
            {{ session('idioma', 'es') == 'es' ? 'Editar Dirección' : 'Edit Address' }}
        </h1>
        
        <form action="{{ route('direcciones.update', $direccion->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'País' : 'Country' }}
                </label>
                <input type="text" name="pais" value="{{ $direccion->pais }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Provincia' : 'Province' }}
                </label>
                <input type="text" name="provincia" value="{{ $direccion->provincia }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Calle' : 'Street' }}
                </label>
                <input type="text" name="calle" value="{{ $direccion->calle }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Código Postal' : 'Postal Code' }}
                </label>
                <input type="text" name="codigo_postal" value="{{ $direccion->codigo_postal }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('direcciones.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    {{ session('idioma', 'es') == 'es' ? 'Volver' : 'Back' }}
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    {{ session('idioma', 'es') == 'es' ? 'Actualizar Dirección' : 'Update Address' }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>
