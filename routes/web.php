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
use App\Http\Controllers\GradoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\InscripcionController;

// --- 1. RUTA PÚBLICA (Landing) ---
Route::get('/', function () {
    return view('landing');
})->name('landing');

// --- 2. AUTENTICACIÓN ---
// 'register' => false impide registro público
Auth::routes(['register' => false]);

// --- 3. RUTAS PROTEGIDAS (Requieren Login) ---
Route::middleware(['auth'])->group(function () {
    
    // --- ACCESO GENERAL (Cualquier usuario logueado) ---
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // =========================================================
    //    ZONA ADMINISTRADOR (Solo rol: Administrador)
    // =========================================================
    Route::middleware(['role:Administrador'])->group(function () {
        
        // Gestión de Usuarios y Roles
        Route::resource('users', UserController::class);
        
        // Rutas manuales de Roles (PermisoController)
        Route::get('/roles', [PermisoController::class, 'roles'])->name('roles.index');
        Route::post('/roles', [PermisoController::class, 'storeRole'])->name('roles.store');
        Route::get('/roles/{id_rol}/permisos', [PermisoController::class, 'edit'])->name('roles.permisos');
        Route::post('/roles/{id_rol}/permisos', [PermisoController::class, 'update'])->name('roles.permisos.update');

        // Gestión Académica (Estructura)
        Route::resource('maestros', MaestroController::class);
        Route::resource('alumnos', AlumnoController::class); 
        Route::resource('materias', MateriaController::class);
        Route::resource('grados', GradoController::class);
        Route::resource('inscripciones', InscripcionController::class);
    });

    // =========================================================
    //    ZONA COMPARTIDA (Administradores y Maestros)
    // =========================================================
    // Aquí irán las calificaciones porque ambos necesitan gestionarlas
    Route::middleware(['role:Administrador,Maestro'])->group(function () {
        
    // Módulo de Asistencias
        Route::resource('asistencias', AsistenciaController::class)->only(['index', 'create', 'store']);
        
        // Aún no hemos creado este controlador, pero dejaremos la ruta lista
        // para cuando hagamos el paso de calificaciones.
        // Route::resource('calificaciones', CalificacionController::class);
    });

    // =========================================================
    //    ZONA ALUMNO (Solo rol: Alumno/Tutor)
    // =========================================================
    Route::middleware(['role:Alumno/Tutor'])->group(function () {
        // Aquí pondremos la ruta para ver sus propias notas
        // Route::get('/mis-calificaciones', [AlumnoController::class, 'misCalificaciones'])->name('alumno.calificaciones');
    });

});

// --- 4. RUTA DE LOGOUT ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); 
})->name('logout');