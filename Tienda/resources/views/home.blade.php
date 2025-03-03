<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Agregamos un estilo personalizado para el efecto de hover */
        .producto:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
            z-index: 10;
            /* Asegura que el producto sobresalga por encima de los demás */
        }

        .producto {
            position: relative;
            overflow: hidden;
        }

        .producto:hover .overlay {
            opacity: 0.5;
        }

        .producto:hover .botones {
            opacity: 1;
            transform: translateY(0);
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .botones {
            position: absolute;
            bottom: 10px;
            left: 50%;

            transform: translate(-50%, 100%);
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
    </style>
</head>

<body>
    @if (session('idioma', 'es') == 'es')

    @auth

    @if(session('success'))
    <div id="success-message" class="fixed top-3 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-semibold transition-opacity duration-500 opacity-100 z-50">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            let successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.opacity = '0'; // Desvanece el mensaje
                setTimeout(() => {
                    successMessage.remove(); // Lo elimina después de desvanecerse
                }, 1000); // Espera 1 segundo tras el desvanecimiento
            }
        }, 4000); // Dura 7 segundos antes de empezar a desvanecerse
    </script>
    @endif



    <!-- Barra de navegación -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center relative">





        <h1 class="text-2xl font-bold">Tienda Laravel</h1>
        <div class="flex items-center space-x-4 relative -left-[100px]">

            <div class="relative inline-block text-left">
                <button id="idiomasButton" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                    <span class="mr-2">Idiomas</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="idiomasMenu" class="hidden absolute mt-2 w-40 bg-white border border-gray-300 rounded shadow-lg z-10">
                    <a href="/cambiar-idioma/es" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Español</a>
                    <a href="/cambiar-idioma/en" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Ingles</a>
                </div>
            </div>


            <img src="{{ !empty(Auth::user()->imagen_usuario) && file_exists(public_path('imagenes/' . Auth::user()->imagen_usuario)) 
            ? asset('imagenes/' . Auth::user()->imagen_usuario) 
            : 'https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png' }}" 
     alt="Usuario" 
     class="w-8 h-8 rounded-full border-2 border-black object-cover shadow-lg">


            <span class="font-semibold">{{Auth::user()->usuario}}</span>
            <div class="relative inline-block text-left">
                <button id="dropdownButton" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                    <span class="mr-2">Menú</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="dropdownMenu" class="hidden absolute mt-2 w-40 bg-white border border-gray-300 rounded shadow-lg z-10">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Perfil</a>
                    <a href="{{ route( 'pedidos.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Pedidos</a>
                    @if(auth()->user()->rol === 'admin')
                    <a href="{{ route( 'usuarios.administracion') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Administracion</a>
                    @endif

                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Cerrar sesión</a>
                </div>
            </div>

        </div>
    </nav>


    <!-- Contenedor de Productos -->
    <div class="container mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold text-center mb-8">Productos Destacados</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Producto 1 -->
            @foreach($productos as $producto)
            <div class="producto bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overlay"></div>
                <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" alt="{{ $producto->nombre }}" class="h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold">{{ $producto->nombre }}</h3>
                    <p class="text-gray-700 mt-2">$ {{ number_format($producto->precio, 2) }}</p>
                </div>
                <div class="botones">
                    <form id="form-{{ $producto->id }}" action="{{ route('pedido.agregar.actual') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                        <input type="hidden" name="cantidad" value="1">
                    </form>
                    <button
                        onclick="window.location.href='{{ route('productos.detalle', $producto->id) }}'"
                        class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                        Info
                    </button>

                    <button onclick="document.getElementById('form-{{ $producto->id }}').submit();" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 mr-3">Añadir al carrito</button>
                </div>
            </div>
            @endforeach

        </div>

        <script>
            document.getElementById('dropdownButton').addEventListener('click', function() {
                document.getElementById('dropdownMenu').classList.toggle('hidden');
            });
            document.getElementById('idiomasButton').addEventListener('click', function() {
                document.getElementById('idiomasMenu').classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!document.getElementById('dropdownButton').contains(event.target)) {
                    document.getElementById('dropdownMenu').classList.add('hidden');
                }
            });
        </script>

        @endauth

        @guest
        <!-- Barra de navegación -->
        <nav class="bg-white shadow-md p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Tienda Laravel</h1>

            <div class="flex items-center space-x-4 relative -left-[100px]">
                <div class="relative inline-block text-left">
                    <button id="idiomasButton" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                        <span class="mr-2">Idiomas</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="idiomasMenu" class="hidden absolute mt-2 w-40 bg-white border border-gray-300 rounded shadow-lg z-10">
                        <a href="/cambiar-idioma/es" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Español</a>
                        <a href="/cambiar-idioma/en" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Ingles</a>
                    </div>
                </div>

                <div>

                    <button id="botonLogin" href="{{ route(  'login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Iniciar sesión</button>

                    <button onclick="window.location.href='{{ route('register') }}'"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                        Registrarse
                    </button>
                </div>
            </div>
        </nav>

        <!-- Contenedor de Productos -->
        <div class="container mx-auto px-4 py-10">
            <h2 class="text-3xl font-bold text-center mb-8">Productos Destacados</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach($productos as $producto)
                <div class="producto bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overlay"></div>
                    <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" alt="{{ $producto->nombre }}" class="h-64 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">{{ $producto->nombre }}</h3>
                        <p class="text-gray-700 mt-2">$ {{ number_format($producto->precio, 2) }}</p>
                    </div>
                    <div class="botones">
                        <button onclick="window.location.href='{{ route('login') }}'"
                            class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">Info</button>

                    </div>
                </div>
                @endforeach


            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loginButton = document.getElementById('botonLogin');
                if (loginButton) {
                    loginButton.addEventListener('click', function() {
                        // Obtener la URL actual
                        const currentUrl = window.location.href;

                        // Redirigir al login con el parámetro 'redirect'
                        window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(currentUrl);
                    });
                }
                document.getElementById('idiomasButton').addEventListener('click', function() {
                    document.getElementById('idiomasMenu').classList.toggle('hidden');
                })

            });
        </script>
        @endguest
        @else

        @auth

        @if(session('success'))
    <div id="success-message" class="fixed top-3 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-semibold transition-opacity duration-500 opacity-100 z-50">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            let successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.opacity = '0'; // Desvanece el mensaje
                setTimeout(() => {
                    successMessage.remove(); // Lo elimina después de desvanecerse
                }, 1000); // Espera 1 segundo tras el desvanecimiento
            }
        }, 4000); // Dura 7 segundos antes de empezar a desvanecerse
    </script>
    @endif
        <!-- Barra de navegación -->
        <nav class="bg-white shadow-md p-4 flex justify-between items-center relative">





            <h1 class="text-2xl font-bold">Laravel Store</h1>
            <div class="flex items-center space-x-4 relative -left-[100px]">

                <div class="relative inline-block text-left">
                    <button id="idiomasButton" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                        <span class="mr-2">Languages</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="idiomasMenu" class="hidden absolute mt-2 w-40 bg-white border border-gray-300 rounded shadow-lg z-10">
                        <a href="/cambiar-idioma/es" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Spanish</a>
                        <a href="/cambiar-idioma/en" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">English</a>
                    </div>
                </div>


                <img src="{{ !empty(Auth::user()->imagen_usuario) && file_exists(public_path('imagenes/' . Auth::user()->imagen_usuario)) 
                ? asset('imagenes/' . Auth::user()->imagen_usuario) 
                : 'https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png' }}" 
         alt="Usuario" 
         class="w-8 h-8 rounded-full border-2 border-black object-cover shadow-lg">
                <span class="font-semibold">{{Auth::user()->usuario}}</span>
                <div class="relative inline-block text-left">
                    <button id="dropdownButton" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                        <span class="mr-2">Menu</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="hidden absolute mt-2 w-40 bg-white border border-gray-300 rounded shadow-lg z-10">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                        <a href="{{ route( 'pedidos.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Order</a>
                        @if(auth()->user()->rol === 'admin')
                        <a href="{{ route( 'usuarios.administracion') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Administration</a>
                        @endif

                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Log out</a>
                    </div>
                </div>

            </div>
        </nav>


        <!-- Contenedor de Productos -->
        <div class="container mx-auto px-4 py-10">
            <h2 class="text-3xl font-bold text-center mb-8">Main Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Producto 1 -->
                @foreach($productos as $producto)
                <div class="producto bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overlay"></div>
                    <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" alt="{{ $producto->nombre }}" class="h-64 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">{{ $producto->nombreIngles }}</h3>
                        <p class="text-gray-700 mt-2">$ {{ number_format($producto->precio, 2) }}</p>
                    </div>
                    <div class="botones">
                        <button
                            onclick="window.location.href='{{ route('productos.detalle', $producto->id) }}'"
                            class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                            Info
                        </button>
                        <form id="form-{{ $producto->id }}" action="{{ route('pedido.agregar.actual') }}" method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="hidden" name="cantidad" value="1">
                        </form>
                        <button onclick="document.getElementById('form-{{ $producto->id }}').submit();" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 mr-3">Add to shopping cart</button> 
                    </div>
                </div>
                @endforeach

            </div>

            <script>
                document.getElementById('dropdownButton').addEventListener('click', function() {
                    document.getElementById('dropdownMenu').classList.toggle('hidden');
                });
                document.getElementById('idiomasButton').addEventListener('click', function() {
                    document.getElementById('idiomasMenu').classList.toggle('hidden');
                });

                document.addEventListener('click', function(event) {
                    if (!document.getElementById('dropdownButton').contains(event.target)) {
                        document.getElementById('dropdownMenu').classList.add('hidden');
                    }
                });
            </script>

            @endauth

            @guest
            <!-- Barra de navegación -->
            <nav class="bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Laravel Store</h1>
                <div class="flex items-center space-x-4 relative -left-[100px]">

                    <div class="relative inline-block text-left">
                        <button id="idiomasButton" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                            <span class="mr-2">Languages</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="idiomasMenu" class="hidden absolute mt-2 w-40 bg-white border border-gray-300 rounded shadow-lg z-10">
                            <a href="/cambiar-idioma/es" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Spanish</a>
                            <a href="/cambiar-idioma/en" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">English</a>
                        </div>
                    </div>
                    <div>

                        <button id="botonLogin" href="{{ route(  'login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Login</button>

                        <button onclick="window.location.href='{{ route('register') }}'"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                            Register
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Contenedor de Productos -->
            <div class="container mx-auto px-4 py-10">
                <h2 class="text-3xl font-bold text-center mb-8">Main products</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

                    @foreach($productos as $producto)
                    <div class="producto bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="overlay"></div>
                        <img src="{{ asset('imagenes/' . $producto->imagen_producto) }}" alt="{{ $producto->nombre }}" class="h-64 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold">{{ $producto->nombreIngles }}</h3>
                            <p class="text-gray-700 mt-2">$ {{ number_format($producto->precio, 2) }}</p>
                        </div>
                        <div class="botones">
                            <button onclick="window.location.href='{{ route('login') }}'"
                                class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">Info</button>

                        </div>
                    </div>
                    @endforeach


                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const loginButton = document.getElementById('botonLogin');
                    if (loginButton) {
                        loginButton.addEventListener('click', function() {
                            // Obtener la URL actual
                            const currentUrl = window.location.href;

                            // Redirigir al login con el parámetro 'redirect'
                            window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(currentUrl);
                        });
                    }
                    document.getElementById('idiomasButton').addEventListener('click', function() {
                        document.getElementById('idiomasMenu').classList.toggle('hidden');
                    })

                });
            </script>
            @endguest
            @endif




</body>

</html>