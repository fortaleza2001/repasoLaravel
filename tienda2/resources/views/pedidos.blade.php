<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ session('idioma', 'es') == 'es' ? 'Pedidos' : 'Orders' }}
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="absolute top-4 left-4">
        <a href="{{ url('/') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
            ← {{ session('idioma', 'es') == 'es' ? 'Volver al Inicio' : 'Back to Home' }}
        </a>
    </div>

    @if(session('success'))
            <div class="bg-green-500 text-center text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">
            📦 {{ session('idioma', 'es') == 'es' ? 'Pedidos' : 'Orders' }}
        </h1>

        <!-- Pedido en curso -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">🛒 
                {{ session('idioma', 'es') == 'es' ? 'Pedido en curso' : 'Order in Progress' }}
            </h2>

            @if(session()->has('pedido') && !empty(session('pedido')))
                <div class="p-4 border border-gray-300 rounded-lg bg-gray-50">
                    <p class="font-medium mb-2">
                        {{ session('idioma', 'es') == 'es' ? 'Detalles del pedido:' : 'Order Details:' }}
                    </p>

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 border">{{ session('idioma', 'es') == 'es' ? 'Producto' : 'Product' }}</th>
                                <th class="p-2 border">{{ session('idioma', 'es') == 'es' ? 'Cantidad' : 'Quantity' }}</th>
                                <th class="p-2 border">{{ session('idioma', 'es') == 'es' ? 'Precio Unidad' : 'Unit Price' }}</th>
                                <th class="p-2 border">{{ session('idioma', 'es') == 'es' ? 'Precio Total' : 'Total Price' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalPedido = 0;
                            @endphp
                            @foreach(session('pedido') as $producto)
                                @php
                                    $precioTotal = $producto['cantidad'] * $producto['precio'];
                                    $totalPedido += $precioTotal;
                                @endphp
                                <tr>
                                    <td class="p-2 border">{{ $producto['nombre'] }}</td>
                                    <td class="p-2 border text-center">{{ $producto['cantidad'] }}</td>
                                    <td class="p-2 border text-center">{{ number_format($producto['precio'], 2) }}€</td>
                                    <td class="p-2 border text-center font-semibold">{{ number_format($precioTotal, 2) }}€</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Total del pedido -->
                    <div class="mt-4 text-right font-semibold text-lg">
                        {{ session('idioma', 'es') == 'es' ? 'Total' : 'Total' }}: {{ number_format($totalPedido, 2) }}€
                    </div>

                    <!-- Botón para completar el pedido -->
                    <form action="{{ route('crear.pedido') }}" method="GET" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                            ✅ {{ session('idioma', 'es') == 'es' ? 'Completar Pedido' : 'Complete Order' }}
                        </button>
                    </form>
                </div>
            @else
                <p class="text-gray-500">
                    {{ session('idioma', 'es') == 'es' ? 'No tienes ningún pedido en curso.' : 'You have no orders in progress.' }}
                </p>
            @endif
        </div>

        <!-- Lista de pedidos -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">📋 
                {{ session('idioma', 'es') == 'es' ? 'Lista de pedidos' : 'Order List' }}
            </h2>

            <button id="togglePedidos" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 transition">
                🔍 {{ session('idioma', 'es') == 'es' ? 'Ver pedidos anteriores' : 'View Previous Orders' }}
            </button>

            <div id="pedidosContainer" class="hidden">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">
                                {{ session('idioma', 'es') == 'es' ? 'Fecha de compra' : 'Purchase Date' }}
                            </th>
                            <th class="border p-2">
                                {{ session('idioma', 'es') == 'es' ? 'Fecha de llegada' : 'Arrival Date' }}
                            </th>
                            <th class="border p-2">
                                {{ session('idioma', 'es') == 'es' ? 'Estado' : 'Status' }}
                            </th>
                            <th class="border p-2">
                                {{ session('idioma', 'es') == 'es' ? 'Acción' : 'Action' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $pedido)
                            @php
                                $estado = now()->greaterThan($pedido->fecha_aproximada_entrega) 
                                    ? (session('idioma', 'es') == 'es' ? 'Recibido' : 'Received') 
                                    : (session('idioma', 'es') == 'es' ? 'Enviado' : 'Shipped');
                                $estadoClase = $estado === 'Recibido' ? 'bg-green-500' : 'bg-blue-500';
                            @endphp
                            <tr class="odd:bg-gray-50 even:bg-white">
                                <td class="border p-2 text-center">{{ $pedido->id }}</td>
                                <td class="border p-2 text-center">{{ $pedido->created_at->format('d/m/Y') }}</td>
                                <td class="border p-2 text-center">
                                    {{ optional($pedido->fecha_aproximada_entrega)->format('d/m/Y') ?? 
                                    (session('idioma', 'es') == 'es' ? 'Sin fecha' : 'No date') }}
                                </td>
                                <td class="border p-2 text-center">
                                    <span class="px-2 py-1 text-white text-sm rounded {{ $estadoClase }}">
                                        {{ $estado }}
                                    </span>
                                </td>
                                <td class="border p-2 text-center">
                                    <a href="{{ route('pedidos.show', ['id' => $pedido->id]) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                                        👀 {{ session('idioma', 'es') == 'es' ? 'Ver Pedido' : 'View Order' }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border p-4 text-center text-gray-500">
                                    {{ session('idioma', 'es') == 'es' ? 'No tienes pedidos anteriores.' : 'No previous orders.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePedidos').addEventListener('click', function () {
            document.getElementById('pedidosContainer').classList.toggle('hidden');
        });
    </script>
</body>
</html>
