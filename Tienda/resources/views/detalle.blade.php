<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @if (session('idioma', 'es') == 'es')
    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg max-w-4xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Imagen del producto -->
            <div class="flex justify-center">
                <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" alt="{{ $producto->nombre }}" class="rounded-lg shadow-md w-full">
            </div>

            <!-- Información del producto -->
            <div class="flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $producto->nombre }}</h1>
                    <p class="text-gray-600 text-sm mt-1">Proveedor:
                        <span class="font-medium">{{ $producto->proveedor->nombre ?? 'Desconocido' }}</span>
                    </p>
                    <p class="text-xl font-semibold text-green-600 mt-4">${{ number_format($producto->precio, 2) }}</p>
                    <p class="text-gray-700 mt-4">
                        {{ $producto->descripcion }}
                    </p>
                </div>

                <!-- Selector de cantidad y botón de compra -->
                <div class="mt-6">
                    <label for="cantidad" class="text-gray-700 font-medium">Cantidad:</label>
                    <div class="flex items-center space-x-2 mt-2">
                        <form action="{{ route('pedido.agregar.actual') }}" method="POST">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="number" name="cantidad" id="cantidad" min="1" value="1"
                                class="w-16 border border-gray-300 p-2 rounded-lg text-center text-gray-900">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Añadir al carrito
                            </button>
                        </form>
                    </div>
                </div>


                <!-- Botón de volver -->
                <div class="mt-6">
                    <a href="{{ url('/') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
                        ← Volver al Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg max-w-4xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Imagen del producto -->
            <div class="flex justify-center">
                <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" alt="{{ $producto->nombre }}" class="rounded-lg shadow-md w-full">
            </div>

            <!-- Información del producto -->
            <div class="flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $producto->nombreIngles }}</h1>
                    <p class="text-gray-600 text-sm mt-1">Provider:
                        <span class="font-medium">{{ $producto->proveedor->nombre ?? 'Unknown' }}</span>
                    </p>
                    <p class="text-xl font-semibold text-green-600 mt-4">${{ number_format($producto->precio, 2) }}</p>
                    <p class="text-gray-700 mt-4">
                        {{ $producto->descripcionIngles }}
                    </p>
                </div>

                <!-- Selector de cantidad y botón de compra -->
                <div class="mt-6">
                    <label for="cantidad" class="text-gray-700 font-medium">Quantity:</label>
                    <div class="flex items-center space-x-2 mt-2">
                        <form action="{{ route('pedido.agregar.actual') }}" method="POST">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="number" name="cantidad" id="cantidad" min="1" value="1"
                                class="w-16 border border-gray-300 p-2 rounded-lg text-center text-gray-900">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Add to shopping cart
                            </button>
                        </form>
                    </div>
                </div>


                <!-- Botón de volver -->
                <div class="mt-6">
                    <a href="{{ url('/') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
                        ← Back Home
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

</body>

</html>