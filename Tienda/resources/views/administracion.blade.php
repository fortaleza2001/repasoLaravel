<!DOCTYPE html>
<html lang="{{ session('idioma', 'es') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ session('idioma', 'es') == 'es' ? 'Gestión de Tienda' : 'Store Management' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center">

    <div class="absolute top-4 left-4">
        <a href="{{ route('productos.home')}}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
            ← {{ session('idioma', 'es') == 'es' ? 'Volver al Inicio' : 'Back to Home' }}
        </a>
    </div>

    <div class="container mx-auto mt-8 p-8 max-w-4xl bg-white shadow-xl rounded-lg">
        <h1 class="text-3xl font-bold text-center mb-6">
            {{ session('idioma', 'es') == 'es' ? 'Gestión de Tienda' : 'Store Management' }}
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{route('productos.index')}}" class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg flex items-center justify-center transition">
                <span class="text-lg font-semibold">
                    {{ session('idioma', 'es') == 'es' ? 'Gestión de Productos' : 'Product Management' }}
                </span>
            </a>

            <a href="{{route('pedidos.gestion')}}" class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg flex items-center justify-center transition">
                <span class="text-lg font-semibold">
                    {{ session('idioma', 'es') == 'es' ? 'Gestión de Pedidos' : 'Order Management' }}
                </span>
            </a>

            <a href="{{route('usuarios.index')}}" class="bg-purple-500 hover:bg-purple-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg flex items-center justify-center transition">
                <span class="text-lg font-semibold">
                    {{ session('idioma', 'es') == 'es' ? 'Gestión de Usuarios' : 'User Management' }}
                </span>
            </a>

            <a href="{{route('proveedores.index')}}" class="bg-red-500 hover:bg-red-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg flex items-center justify-center transition">
                <span class="text-lg font-semibold">
                    {{ session('idioma', 'es') == 'es' ? 'Gestión de Proveedores' : 'Supplier Management' }}
                </span>
            </a>

            <a href="{{route('descuentos.index')}}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg flex items-center justify-center transition">
                <span class="text-lg font-semibold">
                    {{ session('idioma', 'es') == 'es' ? 'Gestión de Descuentos' : 'Discount Management' }}
                </span>
            </a>

            <a href="{{route('direcciones.index')}}" class="bg-gray-500 hover:bg-gray-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg flex items-center justify-center transition">
                <span class="text-lg font-semibold">
                    {{ session('idioma', 'es') == 'es' ? 'Gestión de Direcciones' : 'Address Management' }}
                </span>
            </a>
        </div>
    </div>

</body>
</html>
