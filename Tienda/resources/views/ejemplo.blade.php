
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
@auth
    <p>Estas logueado</p>
@endauth

@guest
    <p>No estás logueado</p>
    <button id="loginButton">Iniciar sesión</button>
@endguest

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginButton = document.getElementById('loginButton');
        if (loginButton) {
            loginButton.addEventListener('click', function() {
                // Obtener la URL actual
                const currentUrl = window.location.href;

                // Redirigir al login con el parámetro 'redirect'
                window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(currentUrl);
            });
        }
    });
</script>

</body>
</html>
