<!DOCTYPE html>
<html lang="{{ session('idioma', 'es') == 'es' ? 'es' : 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ session('idioma', 'es') == 'es' ? 'Gestión de Direcciones' : 'Address Management' }}
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="absolute top-4 left-4">
        <a href="{{ route('usuarios.administracion') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
            ← {{ session('idioma', 'es') == 'es' ? 'Volver al Inicio' : 'Back to Home' }}
        </a>
    </div>
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">
                {{ session('idioma', 'es') == 'es' ? 'Gestión de Direcciones' : 'Address Management' }}
            </h1>
            <a href="{{ route('dirreccion.create') }}" 
               class="bg-green-500 text-white px-4 py-2 rounded text-sm">
                {{ session('idioma', 'es') == 'es' ? 'Agregar Dirección' : 'Add Address' }}
            </a>
        </div>

        <!-- Filtros de búsqueda -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <input type="text" id="searchPais" class="p-2 border border-gray-300 rounded" 
                   placeholder="{{ session('idioma', 'es') == 'es' ? 'Buscar por país...' : 'Search by country...' }}">

            <input type="text" id="searchProvincia" class="p-2 border border-gray-300 rounded" 
                   placeholder="{{ session('idioma', 'es') == 'es' ? 'Buscar por provincia...' : 'Search by province...' }}">

            <input type="text" id="searchCodigoPostal" class="p-2 border border-gray-300 rounded" 
                   placeholder="{{ session('idioma', 'es') == 'es' ? 'Buscar por código postal...' : 'Search by postal code...' }}">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 text-left">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'ID' : 'ID' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'País' : 'Country' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'Provincia' : 'Province' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'Calle' : 'Street' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'Código Postal' : 'Postal Code' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'Acciones' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody id="direccionTable" class="bg-white divide-y divide-gray-200">
                    @foreach($direcciones as $direccion)
                        <tr class="hover:bg-gray-100">
                            <td class="p-3">{{ $direccion->id }}</td>
                            <td class="p-3 pais">{{ $direccion->pais }}</td>
                            <td class="p-3 provincia">{{ $direccion->provincia }}</td>
                            <td class="p-3">{{ $direccion->calle }}</td>
                            <td class="p-3 codigo_postal">{{ $direccion->codigo_postal }}</td>
                            <td class="p-3 flex space-x-2">
                                <a href="{{ route('direcciones.edit', $direccion->id) }}" 
                                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    {{ session('idioma', 'es') == 'es' ? 'Editar' : 'Edit' }}
                                </a>
                                <form action="{{ route('direcciones.destroy', $direccion->id) }}" method="POST" 
                                      class="inline" 
                                      onsubmit="return confirm('{{ session('idioma', 'es') == 'es' ? '¿Seguro que quieres eliminar esta dirección?' : 'Are you sure you want to delete this address?' }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm">
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
            const searchPaisInput = document.getElementById('searchPais');
            const searchProvinciaInput = document.getElementById('searchProvincia');
            const searchCodigoPostalInput = document.getElementById('searchCodigoPostal');
            const rows = document.querySelectorAll('#direccionTable tr');

            function filtrarDirecciones() {
                let searchPais = searchPaisInput.value.toLowerCase();
                let searchProvincia = searchProvinciaInput.value.toLowerCase();
                let searchCodigoPostal = searchCodigoPostalInput.value.toLowerCase();

                rows.forEach(row => {
                    let pais = row.querySelector('.pais').textContent.toLowerCase();
                    let provincia = row.querySelector('.provincia').textContent.toLowerCase();
                    let codigoPostal = row.querySelector('.codigo_postal').textContent.toLowerCase();

                    let matchesPais = pais.includes(searchPais);
                    let matchesProvincia = provincia.includes(searchProvincia);
                    let matchesCodigoPostal = codigoPostal.includes(searchCodigoPostal);

                    row.style.display = (matchesPais && matchesProvincia && matchesCodigoPostal) ? '' : 'none';
                });
            }

            searchPaisInput.addEventListener('keyup', filtrarDirecciones);
            searchProvinciaInput.addEventListener('keyup', filtrarDirecciones);
            searchCodigoPostalInput.addEventListener('keyup', filtrarDirecciones);
        });
    </script>
</body>
</html>
