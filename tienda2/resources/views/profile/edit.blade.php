<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Agregar Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Otras etiquetas meta, enlaces a estilos, etc. -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100">

    <div class="absolute top-4 left-4">
        <a href="{{ url('/') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600">
            ← {{ session('idioma', 'es') == 'es' ? 'Volver al Inicio' : 'Back to Home' }}
        </a>
    </div>

    <!-- Título "Perfil" -->
    <div class="text-center mt-8">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ session('idioma', 'es') == 'es' ? 'Perfil' : 'Profile' }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Sección de avatar del usuario -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-lg">
                <h3 class="text-lg font-medium mb-4">
                    {{ session('idioma', 'es') == 'es' ? 'Avatar del Usuario' : 'User Avatar' }}
                </h3>

                <div class="flex items-center justify-center mb-6">
                    <div class="relative w-60 h-60">
                        <img src="{{ !empty($user->imagen_usuario) && file_exists(public_path('imagenes/' . $user->imagen_usuario)) 
                            ? asset('imagenes/' . $user->imagen_usuario) 
                            : 'https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png' }}"
                            alt="Usuario"
                            class="w-60 h-60 rounded-full border-2 border-black object-cover shadow-lg">

                        @if(empty($user->imagen_usuario))
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-full">
                            <span class="text-white font-semibold">
                                {{ session('idioma', 'es') == 'es' ? 'Sin imagen' : 'No image' }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 ml-8">
                        <button type="button"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600"
                            onclick="document.getElementById('imagen_usuario').click()">
                            {{ session('idioma', 'es') == 'es' ? 'Cambiar Imagen' : 'Change Image' }}
                        </button>

                        <form action="{{ route('usuario.quitar.imagen') }}" method="GET"
                            @php
                            $mensaje_confirmacion=session('idioma', 'es' )=='es'
                            ? '¿Estás seguro de que quieres quitar la imagen?'
                            : 'Are you sure you want to remove the image?' ;
                            @endphp

                            <form action="{{ route('usuario.quitar.imagen') }}" method="GET"
                            onsubmit="return confirm('{{ $mensaje_confirmacion }}');">

                            @csrf
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-red-600">
                                {{ session('idioma', 'es') == 'es' ? 'Quitar Imagen' : 'Remove Image' }}
                            </button>
                        </form>
                    </div>
                </div>

                <form action="{{ route('usuario.subir.imagen') }}" method="POST" enctype="multipart/form-data" class="hidden">
                    @csrf
                    <input type="file" name="imagen_usuario" id="imagen_usuario" class="hidden" accept="image/*" onchange="this.form.submit()">
                </form>
            </div>

            <!-- Formulario para actualizar información de perfil -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Formulario para actualizar contraseña -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Formulario para eliminar usuario -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</body>

</html>