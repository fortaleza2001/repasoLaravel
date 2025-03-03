<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ session('idioma', 'es') == 'es' ? 'Gestión de Descuentos' : 'Discount Management' }}
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="absolute top-4 left-4">
        <a href="{{ route('usuarios.administracion')}}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
            ← {{ session('idioma', 'es') == 'es' ? 'Volver al Inicio' : 'Back to Home' }}
        </a>
    </div>
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">
                {{ session('idioma', 'es') == 'es' ? 'Gestión de Descuentos' : 'Discount Management' }}
            </h1>
            <a href="{{ route('descuentos.create') }}" 
               class="bg-green-500 text-white px-4 py-2 rounded text-sm">
                {{ session('idioma', 'es') == 'es' ? 'Agregar Descuento' : 'Add Discount' }}
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Contenedor de los filtros -->
        <div class="flex space-x-4 mb-4">
            <!-- Buscar por nombre -->
            <input type="text" id="searchName" class="w-1/2 p-2 border border-gray-300 rounded" 
                   placeholder="{{ session('idioma', 'es') == 'es' ? 'Buscar por nombre...' : 'Search by name...' }}">

            <!-- Buscar por porcentaje -->
            <input type="number" id="searchPercentage" class="w-1/2 p-2 border border-gray-300 rounded" 
                   placeholder="{{ session('idioma', 'es') == 'es' ? 'Filtrar por porcentaje exacto ...' : 'Filter by exact percentage...' }}">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 shadow-md">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'ID' : 'ID' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Nombre' : 'Name' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Porcentaje' : 'Percentage' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Fecha de Finalización' : 'End Date' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Descripción' : 'Description' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Acciones' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody id="descuentoTable">
                    @foreach($descuentos as $descuento)
                        <tr class="text-gray-700 bg-white hover:bg-gray-100">
                            <td class="p-3 border">{{ $descuento->id }}</td>
                            <td class="p-3 border nombre">{{ $descuento->nombre }}</td>
                            <td class="p-3 border porcentaje">{{ $descuento->porcentaje }}%</td>
                            <td class="p-3 border">{{ $descuento->fecha_finalizacion }}</td>
                            <td class="p-3 border">{{ $descuento->descripcion }}</td>
                            <td class="p-3 border flex gap-2">
                                <a href="{{ route('descuentos.edit', $descuento->id) }}" 
                                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    {{ session('idioma', 'es') == 'es' ? 'Editar' : 'Edit' }}
                                </a>

                                <form action="{{ route('descuentos.destroy', $descuento->id) }}" method="POST" 
                                      onsubmit="return confirm('{{ session('idioma', 'es') == 'es' ? '¿Seguro que quieres eliminar este descuento?' : 'Are you sure you want to delete this discount?' }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        {{ session('idioma', 'es') == 'es' ? 'Eliminar' : 'Delete' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchNameInput = document.getElementById('searchName');
            const searchPercentageInput = document.getElementById('searchPercentage');
            const rows = document.querySelectorAll('#descuentoTable tr');

            function filtrarDescuentos() {
                let searchName = searchNameInput.value.toLowerCase();
                let maxPercentage = parseFloat(searchPercentageInput.value) || Infinity;

                rows.forEach(row => {
                    let discountName = row.querySelector('.nombre').textContent.toLowerCase();
                    let discountPercentage = parseFloat(row.querySelector('.porcentaje').textContent) || 0;

                    let matchesName = discountName.includes(searchName);
                    let matchesPercentage = discountPercentage <= maxPercentage;

                    row.style.display = (matchesName && matchesPercentage) ? '' : 'none';
                });
            }

            searchNameInput.addEventListener('keyup', filtrarDescuentos);
            searchPercentageInput.addEventListener('input', filtrarDescuentos);
        });
    </script>
</body>
</html>
