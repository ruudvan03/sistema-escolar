<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 

// Importación de Controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\AlumnoController; 
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\AsignacionDocenteController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistema Escolar Preparatoria
|--------------------------------------------------------------------------
*/

// --- 1. RUTA PÚBLICA (Landing Page) ---
Route::get('/', function () {
    return view('landing');
})->name('landing');

// --- 2. AUTENTICACIÓN (UI de Laravel) ---
Auth::routes(['register' => false]); // Desactivar registro público por seguridad

// --- 3. RUTAS PROTEGIDAS (Requieren Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Acceso General (Dashboard unificado)
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // =========================================================
    //    ZONA ADMINISTRADOR (Solo rol: Administrador)
    // =========================================================
    Route::middleware(['role:Administrador'])->group(function () {
        
        // Gestión de Usuarios del Sistema
        Route::resource('users', UserController::class);
        
        // Control de Roles y Permisos
        Route::get('/roles', [PermisoController::class, 'roles'])->name('roles.index');
        Route::post('/roles', [PermisoController::class, 'storeRole'])->name('roles.store');
        Route::get('/roles/{id_rol}/permisos', [PermisoController::class, 'edit'])->name('roles.permisos');
        Route::post('/roles/{id_rol}/permisos', [PermisoController::class, 'update'])->name('roles.permisos.update');

        // Configuración Académica (Catálogos)
        Route::resource('maestros', MaestroController::class);
        Route::resource('alumnos', AlumnoController::class); 
        Route::resource('materias', MateriaController::class);
        Route::resource('grados', GradoController::class);
        Route::resource('grupos', GrupoController::class);
        
        // Control Operativo
        Route::resource('inscripciones', InscripcionController::class);
        Route::resource('asignaciones', AsignacionDocenteController::class);

        // Gestión de Estados de Parciales (Añadido para el control de periodos)
        Route::post('/parciales/{id}/toggle-status', [CalificacionController::class, 'toggleParcialStatus'])->name('parciales.toggle');
    });

    // =========================================================
    //    ZONA COMPARTIDA (Administradores y Maestros)
    // =========================================================
    Route::middleware(['role:Administrador,Maestro'])->group(function () {
        
        // Módulo de Asistencias (Pase de lista diario)
        Route::resource('asistencias', AsistenciaController::class)->only(['index', 'create', 'store']);
        
        // Módulo de Calificaciones (Lógica de 3 Parciales / 18 Puntos)
        Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
        Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');
    });

    // =========================================================
    //    ZONA ALUMNO / TUTOR (Solo su información personal)
    // =========================================================
    Route::middleware(['role:Alumno/Tutor'])->group(function () {
        // Consulta de Boleta Digital (Progreso hacia los 18 puntos)
        Route::get('/mi-boleta', [CalificacionController::class, 'showStudentBoleta'])->name('alumno.boleta');
        
        // Descarga de Boleta en PDF (Añadido para reportes oficiales)
        Route::get('/mi-boleta/descargar', [CalificacionController::class, 'downloadBoletaPDF'])->name('alumno.boleta.pdf');
    });

});

// --- 4. CERRAR SESIÓN ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); 
})->name('logout');