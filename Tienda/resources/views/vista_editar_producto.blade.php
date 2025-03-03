<!DOCTYPE html>
<html lang="{{ session('idioma', 'es') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ session('idioma', 'es') == 'es' ? 'Editar Producto' : 'Edit Product' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

@if (session('idioma', 'es') == 'es')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>
@else
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Edit Product</h1>
@endif

        <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT') 

            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Nombre' : 'Name' }}
                </label>
                <input type="text" name="nombre" value="{{ $producto->nombre }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Precio' : 'Price' }}
                </label>
                <input type="number" name="precio" value="{{ $producto->precio }}" step="0.01" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Proveedor' : 'Supplier' }}
                </label>
                <select name="proveedor_id" class="w-full p-2 border border-gray-300 rounded" required>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ $proveedor->id == $producto->proveedor_id ? 'selected' : '' }}>
                            {{ $proveedor->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Descuento' : 'Discount' }}
                </label>
                <select name="descuento_id" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">{{ session('idioma', 'es') == 'es' ? 'Sin descuento' : 'No discount' }}</option>
                    @foreach($descuentos as $descuento)
                        <option value="{{ $descuento->id }}" {{ $descuento->id == $producto->descuento_id ? 'selected' : '' }}>
                            {{ $descuento->porcentaje }}%
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Descripción' : 'Description' }}
                </label>
                <textarea name="descripcion" class="w-full p-2 border border-gray-300 rounded">{{ $producto->descripcion }}</textarea>
            </div>
            
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Cantidad' : 'Quantity' }}
                </label>
                <input type="number" name="cantidad" value="{{ $producto->cantidad }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Sección para modificar la imagen -->
            <div>
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Imagen Actual' : 'Current Image' }}
                </label>
                <div class="mb-2">
                    @if($producto->imagen_producto)
                        <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" alt="Imagen actual del producto" class="w-32 h-32 object-cover rounded">
                    @else
                        <span class="text-gray-500 italic">{{ session('idioma', 'es') == 'es' ? 'Sin imagen' : 'No image' }}</span>
                    @endif
                </div>
                
                <label class="block text-gray-700">
                    {{ session('idioma', 'es') == 'es' ? 'Subir Nueva Imagen' : 'Upload New Image' }}
                </label>
                <input type="file" name="imagen_producto" accept="image/*" class="w-full p-2 border border-gray-300 rounded">
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('productos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                    {{ session('idioma', 'es') == 'es' ? 'Volver' : 'Back' }}
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    {{ session('idioma', 'es') == 'es' ? 'Actualizar Producto' : 'Update Product' }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>
