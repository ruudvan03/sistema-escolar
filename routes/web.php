<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\UserController;

/*
Landing Page (Pública)
*/
Route::get('/', function () {
    return view('landing');
})->name('landing');

/*
Autenticación (SIN REGISTRO)
*/
Auth::routes([
    'register' => false,
]);

/*
Dashboard (Protegido)
*/
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


/*
Gestión de Roles y Permisos (Protegido)
*/
Route::middleware('auth')->group(function () {

    // Lista de roles
    Route::get('/roles', [PermisoController::class, 'roles'])
        ->name('roles.index');

    // Permisos por rol
    Route::get('/roles/{id_rol}/permisos', [PermisoController::class, 'edit'])
        ->name('roles.permisos');

    // Guardar permisos
    Route::post('/roles/{id_rol}/permisos', [PermisoController::class, 'update'])
        ->name('roles.permisos.update');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/permisos', [PermisoController::class, 'index'])
        ->name('permisos.index');

    Route::post('/permisos', [PermisoController::class, 'store'])
        ->name('permisos.store');

});

Route::middleware('auth')->group(function () {
    // Ver lista de roles
    Route::get('/roles', [PermisoController::class, 'roles'])->name('roles.index');
    
    // Guardar un NUEVO rol
    Route::post('/roles', [PermisoController::class, 'storeRole'])->name('roles.store'); // <--- NUEVA

    // Ver matriz de permisos de un rol
    Route::get('/roles/{id_rol}/permisos', [PermisoController::class, 'edit'])->name('roles.permisos');
    
    // Guardar permisos de un rol
    Route::post('/roles/{id_rol}/permisos', [PermisoController::class, 'update'])->name('roles.permisos.update');
});


Route::middleware('auth')->group(function () {
    // Módulo de Usuarios
    Route::resource('users', UserController::class);
});