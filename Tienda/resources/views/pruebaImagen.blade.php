<form action="{{ route('usuarios.subirImagen') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="imagen_usuario" required>
    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Subir Imagen</button>

    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
</form>
