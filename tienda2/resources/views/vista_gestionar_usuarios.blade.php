<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="absolute top-4 left-4">
        <a href="{{ route('usuarios.administracion')}}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
            ← {{ session('idioma', 'es') == 'es' ? 'Volver al Inicio' : 'Back to Home' }}
        </a>
    </div>
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Gestión de Usuarios</h1>
            <a href="{{route('usuarios.create')}}" class="bg-green-500 text-white px-4 py-2 rounded text-sm">Agregar Usuario</a>
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

        <div class="flex space-x-4 mb-4">
            <input type="text" id="searchName" class="w-1/3 p-2 border border-gray-300 rounded" placeholder="Buscar por nombre...">
            <input type="text" id="searchEmail" class="w-1/3 p-2 border border-gray-300 rounded" placeholder="Buscar por correo electrónico...">
            <input type="text" id="searchRole" class="w-1/3 p-2 border border-gray-300 rounded" placeholder="Buscar por rol...">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 text-left">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Nombre</th>
                        <th class="p-3">Correo</th>
                        <th class="p-3">Rol</th>
                        <th class="p-3">Dirección</th>
                        <th class="p-3">Acciones</th>
                    </tr>
                </thead>
                <tbody id="userTable" class="bg-white divide-y divide-gray-200">
                    @foreach($usuarios as $usuario)
                        <tr class="hover:bg-gray-100">
                            <td class="p-3">{{ $usuario->id }}</td>
                            <td class="p-3 nombre">{{ $usuario->usuario }}</td>
                            <td class="p-3 email">{{ $usuario->email }}</td>
                            <td class="p-3 rol">{{ $usuario->rol }}</td>
                            <td class="p-3 direccion">{{ $usuario->direccion?->calle ?? 'No registrada' }}</td>

                            <td class="p-3 text-center">
                                <div class="flex  space-x-2">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Editar</a>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario? Se eliminaran todos los pedidos del usuario')">Eliminar</button>
                                    </form>
                                </div>
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
            const searchEmailInput = document.getElementById('searchEmail');
            const searchRoleInput = document.getElementById('searchRole');
            const rows = document.querySelectorAll('#userTable tr');

            function filtrarUsuarios() {
                let searchName = searchNameInput.value.toLowerCase();
                let searchEmail = searchEmailInput.value.toLowerCase();
                let searchRole = searchRoleInput.value.toLowerCase();

                rows.forEach(row => {
                    let userName = row.querySelector('.nombre').textContent.toLowerCase();
                    let userEmail = row.querySelector('.email').textContent.toLowerCase();
                    let userRole = row.querySelector('.rol').textContent.toLowerCase();

                    let matchesName = userName.includes(searchName);
                    let matchesEmail = userEmail.includes(searchEmail);
                    let matchesRole = userRole.includes(searchRole);

                    row.style.display = (matchesName && matchesEmail && matchesRole) ? '' : 'none';
                });
            }

            searchNameInput.addEventListener('keyup', filtrarUsuarios);
            searchEmailInput.addEventListener('keyup', filtrarUsuarios);
            searchRoleInput.addEventListener('keyup', filtrarUsuarios);
        });
    </script>
</body>
</html>
