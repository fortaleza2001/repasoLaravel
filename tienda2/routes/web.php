<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [ProductoController::class, 'home'])->name('productos.home');

Route::fallback(function () {
    return redirect()->route('productos.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
        Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
        Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::get('/crearProducto', [ProductoController::class, 'crearProductoVista']) ->name('productos.create');
        Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');


        Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index'); 
        Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
        Route::get('/crearProveedor', [ProveedorController::class, 'crearProveedorVista']) ->name('proveedores.create');
        Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
        Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
        Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');

        Route::get('/descuentos', [DescuentoController::class, 'index'])->name('descuentos.index');    
        Route::get('/crearDescuento', [DescuentoController::class, 'create'])->name('descuentos.create'); 
        Route::get('/descuentos/{id}/edit', [DescuentoController::class, 'edit'])->name('descuentos.edit');
        Route::delete('/descuentos/{id}', [DescuentoController::class, 'destroy'])->name('descuentos.destroy');
        Route::put('/descuentos/{id}', [DescuentoController::class, 'update'])->name('descuentos.update');
        Route::post('/descuentos', [DescuentoController::class, 'store'])->name('descuentos.store');

        Route::get('/direcciones', [DireccionController::class, 'index'])->name('direcciones.index'); 
        Route::delete('/direcciones/{id}', [DireccionController::class, 'destroy'])->name('direcciones.destroy');
        Route::get('/crear-dirreccion', [DireccionController::class, 'create'])->name('dirreccion.create'); 
        Route::post('/direcciones', [DireccionController::class, 'store'])->name('direcciones.store');
        Route::get('/direcciones/{id}/edit', [DireccionController::class, 'edit'])->name('direcciones.edit');
        Route::put('/direcciones/{id}', [DireccionController::class, 'update'])->name('direcciones.update');

        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');  
        Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
        Route::get('/crearUsuario', [UsuarioController::class, 'create'])->name('usuarios.create'); 
        Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');


        Route::get('/administracion', [UsuarioController::class, 'admin'])->name('usuarios.administracion'); 
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   

    

    
    Route::get('/productos/{id}/detalle', [ProductoController::class, 'detalle'])->name('productos.detalle');
    
    Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::get('/gestion/pedidos', [PedidoController::class, 'gestion'])->name('pedidos.gestion');
    Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');

    Route::post('/subir-imagen', [UsuarioController::class, 'subirImagen'])->name('usuario.subir.imagen');
    Route::get('/quitar-imagen', [UsuarioController::class, 'quitarImagen'])->name('usuario.quitar.imagen');

    Route::get('/detalle-producto', function () {
        return view('detalle');
    })->name('detalle-producto');

    Route::get('/crear-pedido', [PedidoController::class, 'crearPedido'])->name('crear.pedido');
    Route::post('/pedido/carrito', [PedidoController::class, 'añadirProductoPedidoActual'])->name('pedido.agregar.actual');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

});

require __DIR__.'/auth.php';


















Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->middleware('auth')->name('logout');








Route::get('/cambiar-idioma/{lang}', function ($lang) {
    Session::put('idioma', $lang);
    return back(); // Redirige a la página anterior
});

