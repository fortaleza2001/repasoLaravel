<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    @if (auth()->user()->rol=='admin')
    <p>
        estas logueado hola admin 
    </p>
    @else
    <p>
        estas logueado hola user 
    </p>
   
    @endif
  
 
    @endauth

    @guest
    <p>
        no estas logueado hola
    </p>
 
     
    @endguest

   
</body>
</html>