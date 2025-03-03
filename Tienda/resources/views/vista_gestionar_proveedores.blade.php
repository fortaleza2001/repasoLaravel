<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ session('idioma', 'es') == 'es' ? 'Gestión de Proveedores' : 'Supplier Management' }}
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
                {{ session('idioma', 'es') == 'es' ? 'Gestión de Proveedores' : 'Supplier Management' }}
            </h1>
            <a href="{{ route('proveedores.create')}}" 
               class="bg-green-500 text-white px-4 py-2 rounded text-sm">
                {{ session('idioma', 'es') == 'es' ? 'Agregar Proveedor' : 'Add Supplier' }}
            </a>
        </div>

        <!-- Filtros -->
        <div class="flex space-x-4 mb-4">
            <!-- Buscar por nombre -->
            <input type="text" id="searchName" class="w-1/2 p-2 border border-gray-300 rounded" 
                   placeholder="{{ session('idioma', 'es') == 'es' ? 'Buscar por nombre...' : 'Search by name...' }}">

            <!-- Buscar por teléfono -->
            <input type="text" id="searchPhone" class="w-1/2 p-2 border border-gray-300 rounded" 
                   placeholder="{{ session('idioma', 'es') == 'es' ? 'Buscar por teléfono...' : 'Search by phone...' }}">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 shadow-md">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'ID' : 'ID' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Nombre' : 'Name' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Dirección' : 'Address' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Descripción' : 'Description' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Teléfono' : 'Phone' }}</th>
                        <th class="p-3 border">{{ session('idioma', 'es') == 'es' ? 'Acciones' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody id="proveedorTable">
                    @foreach($proveedores as $proveedor)
                        <tr class="text-gray-700 bg-white hover:bg-gray-100">
                            <td class="p-3 border">{{ $proveedor->id }}</td>
                            <td class="p-3 border nombre">{{ $proveedor->nombre_completo }}</td>
                            <td class="p-3 border">{{ $proveedor->direccion }}</td>
                            <td class="p-3 border">{{ $proveedor->descripcion }}</td>
                            <td class="p-3 border telefono">{{ $proveedor->telefono }}</td>
                            <td class="p-3 border flex gap-2">
                                <a href="{{ route('proveedores.edit', $proveedor->id) }}" 
                                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    {{ session('idioma', 'es') == 'es' ? 'Editar' : 'Edit' }}
                                </a>

                                <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" 
                                      onsubmit="return confirm('{{ session('idioma', 'es') == 'es' ? '¿Seguro que quieres eliminar este proveedor?' : 'Are you sure you want to delete this supplier?' }}');">
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
            const searchPhoneInput = document.getElementById('searchPhone');
            const rows = document.querySelectorAll('#proveedorTable tr');

            function filtrarProveedores() {
                let searchName = searchNameInput.value.toLowerCase();
                let searchPhone = searchPhoneInput.value.toLowerCase();

                rows.forEach(row => {
                    let providerName = row.querySelector('.nombre').textContent.toLowerCase();
                    let providerPhone = row.querySelector('.telefono').textContent.toLowerCase();

                    let matchesName = providerName.includes(searchName);
                    let matchesPhone = providerPhone.includes(searchPhone);

                    row.style.display = (matchesName && matchesPhone) ? '' : 'none';
                });
            }

            searchNameInput.addEventListener('keyup', filtrarProveedores);
            searchPhoneInput.addEventListener('keyup', filtrarProveedores);
        });
    </script>
</body>
</html>
