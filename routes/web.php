<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\AlumnoController; 
use App\Http\Controllers\MateriaController;


// Página Pública (Landing)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Autenticación 
// 'register' => false impide que gente externa se registre sola
Auth::routes(['register' => false]);

// --- RUTAS PROTEGIDAS (SISTEMA) ---
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 2. Módulo de Roles y Permisos
    Route::get('/roles', [PermisoController::class, 'roles'])->name('roles.index');
    Route::post('/roles', [PermisoController::class, 'storeRole'])->name('roles.store');
    Route::get('/roles/{id_rol}/permisos', [PermisoController::class, 'edit'])->name('roles.permisos');
    Route::post('/roles/{id_rol}/permisos', [PermisoController::class, 'update'])->name('roles.permisos.update');

    // 3. Módulo de Usuarios
    Route::resource('users', UserController::class);

    // 4. Módulo de Docentes (Maestros)
    Route::resource('maestros', MaestroController::class);

    // 5. Módulo de Alumnos (NUEVO)
    Route::resource('alumnos', AlumnoController::class);

    // 6. Módulo de Materias
    Route::resource('materias', MateriaController::class);
});

// --- RUTA DE LOGOUT (SALIDA) ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); // Redirige a la Landing Page
})->name('logout');