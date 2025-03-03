<!DOCTYPE html>
<html lang="{{ session('idioma', 'es') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ session('idioma', 'es') == 'es' ? 'Crear Producto' : 'Create Product' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

@if (session('idioma', 'es') == 'es')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Crear Nuevo Producto</h1>
        
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">Precio</label>
                <input type="number" name="precio" step="0.01" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">Proveedor</label>
                <select name="proveedor_id" class="w-full p-2 border border-gray-300 rounded" required>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700">Descuento</label>
                <select name="descuento_id" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Sin descuento</option>
                    @foreach($descuentos as $descuento)
                        <option value="{{ $descuento->id }}">{{ $descuento->porcentaje }}%</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700">Descripción</label>
                <textarea name="descripcion" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            
            <div>
                <label class="block text-gray-700">Cantidad</label>
                <input type="number" name="cantidad" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label class="block text-gray-700">Imagen del Producto</label>
                <input type="file" name="imagen_producto" id="imagen_producto" accept="image/*" class="w-full p-2 border border-gray-300 rounded" onchange="previewImage(event)">
                <img id="preview" class="mt-2 w-32 h-32 object-cover rounded hidden" />
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('productos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Volver</a>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Guardar Producto</button>
            </div>
        </form>
    </div>

@else
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Create New Product</h1>
        
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">Name</label>
                <input type="text" name="nombre" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">Price</label>
                <input type="number" name="precio" step="0.01" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            
            <div>
                <label class="block text-gray-700">Supplier</label>
                <select name="proveedor_id" class="w-full p-2 border border-gray-300 rounded" required>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700">Discount</label>
                <select name="descuento_id" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">No discount</option>
                    @foreach($descuentos as $descuento)
                        <option value="{{ $descuento->id }}">{{ $descuento->porcentaje }}%</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700">Description</label>
                <textarea name="descripcion" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            
            <div>
                <label class="block text-gray-700">Quantity</label>
                <input type="number" name="cantidad" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label class="block text-gray-700">Product Image</label>
                <input type="file" name="imagen_producto" id="imagen_producto" accept="image/*" class="w-full p-2 border border-gray-300 rounded" onchange="previewImage(event)">
                <img id="preview" class="mt-2 w-32 h-32 object-cover rounded hidden" />
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('productos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back</a>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save Product</button>
            </div>
        </form>
    </div>
@endif

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('preview');
            preview.src = reader.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
