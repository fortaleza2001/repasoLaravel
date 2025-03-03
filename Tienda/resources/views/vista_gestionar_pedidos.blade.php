<!DOCTYPE html>
<html lang="{{ session('idioma', 'es') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ session('idioma', 'es') == 'es' ? 'Gestión de Pedidos' : 'Order Management' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="absolute top-4 left-4">
        <a href="{{ route('route('usuarios.administracion') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
            ← {{ session('idioma', 'es') == 'es' ? 'Volver al Inicio' : 'Back to Home' }}
        </a>
    </div>
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">
                {{ session('idioma', 'es') == 'es' ? 'Gestión de Pedidos' : 'Order Management' }}
            </h1>
        </div>
        
        <input type="text" id="search" class="w-full p-2 border border-gray-300 rounded mb-4" 
               placeholder="{{ session('idioma', 'es') == 'es' ? 'Buscar pedido...' : 'Search order...' }}">
        
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 text-left">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'ID' : 'ID' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'Fecha de Compra' : 'Purchase Date' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'Fecha de Entrega' : 'Delivery Date' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'Usuario' : 'User' }}</th>
                        <th class="p-3">{{ session('idioma', 'es') == 'es' ? 'Acciones' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody id="pedidoTable" class="bg-white divide-y divide-gray-200">
                    @foreach($pedidos as $pedido)
                        <tr class="hover:bg-gray-100">
                            <td class="p-3">{{ $pedido->id }}</td>
                            <td class="p-3">{{ $pedido->fecha_compra->format('d/m/Y') }}</td>
                            <td class="p-3">{{ $pedido->fecha_aproximada_entrega->format('d/m/Y') }}</td>
                            <td class="p-3">
                                {{ $pedido->usuario->usuario ?? (session('idioma', 'es') == 'es' ? 'Sin usuario' : 'No user') }}
                            </td>
                            <td class="p-3 flex space-x-2">
                                <a href="{{ route('pedidos.show', ['id' => $pedido->id]) }}" 
                                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    {{ session('idioma', 'es') == 'es' ? 'Ver' : 'View' }}
                                </a>
                                <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm"
                                        onclick="return confirm('{{ session('idioma', 'es') == 'es' ? '¿Estás seguro de que deseas eliminar este pedido?' : 'Are you sure you want to delete this order?' }}')">
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
        document.getElementById('search').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#pedidoTable tr');
            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
