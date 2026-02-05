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


// --- 1. RUTA PÚBLICA (Landing Page) ---
Route::get('/', function () {
    return view('landing');
})->name('landing');

// --- 2. AUTENTICACIÓN ---
Auth::routes(['register' => false]); 

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

        // GESTIÓN DE PERIODOS (Cierre de Parciales)
        // Ruta para ver la lista de parciales y su estatus
        Route::get('/configuracion/parciales', [CalificacionController::class, 'parcialesIndex'])->name('parciales.index');
        // Ruta para abrir/cerrar un parcial
        Route::post('/parciales/{id}/toggle-status', [CalificacionController::class, 'toggleParcialStatus'])->name('parciales.toggle');
    });

    // =========================================================
    //    ZONA COMPARTIDA (Administradores y Maestros)
    // =========================================================
    Route::middleware(['role:Administrador,Maestro'])->group(function () {
        
        // Módulo de Asistencias
        Route::resource('asistencias', AsistenciaController::class)->only(['index', 'create', 'store']);
        
        // Módulo de Calificaciones
        Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
        Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');
    });

    // =========================================================
    //    ZONA ALUMNO / TUTOR
    // =========================================================
    Route::middleware(['role:Alumno/Tutor'])->group(function () {
        // MODIFICACIÓN: Ahora el AlumnoController gestiona la boleta web y el PDF
        // Vista de consulta rápida en el navegador
        Route::get('/mi-boleta', [AlumnoController::class, 'verBoleta'])->name('alumno.boleta');
        // Generación y descarga del documento oficial en PDF
        Route::get('/mi-boleta/descargar', [AlumnoController::class, 'descargarPDF'])->name('alumno.boleta.pdf');
    });

});

// --- 4. CERRAR SESIÓN ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); 
})->name('logout');