<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaestroController;



// Página Pública (Landing)
Route::get('/', function () {
    return view('landing');
})->name('landing');

//Autenticación
// Desactivamos el registro público para que solo el admin cree usuarios
Auth::routes(['register' => false]);

// Rutas Protegidas (Requieren Login)
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home'); // Redirección estándar

    // 2. Módulo de Roles y Permisos
    Route::get('/roles', [PermisoController::class, 'roles'])->name('roles.index');
    Route::post('/roles', [PermisoController::class, 'storeRole'])->name('roles.store');
    Route::get('/roles/{id_rol}/permisos', [PermisoController::class, 'edit'])->name('roles.permisos');
    Route::post('/roles/{id_rol}/permisos', [PermisoController::class, 'update'])->name('roles.permisos.update');

    // 3. Módulo de Usuarios
    Route::resource('users', UserController::class);

    // 4. Módulo de Docentes (Maestros)
    Route::resource('maestros', MaestroController::class);

});