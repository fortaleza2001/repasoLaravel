<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón Desplegable</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center h-screen bg-gray-100">
    <div class="relative inline-block text-left">
        <button id="dropdownButton" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
            <span class="mr-2"></span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        
        <div id="dropdownMenu" class="hidden absolute mt-2 w-40 bg-white border border-gray-300 rounded shadow-lg">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Opción 1</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Opción 2</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Opción 3</a>
        </div>
    </div>

    <script>
        document.getElementById('dropdownButton').addEventListener('click', function() {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!document.getElementById('dropdownButton').contains(event.target)) {
                document.getElementById('dropdownMenu').classList.add('hidden');
            }
        });
    </script>
</body>
</html>
