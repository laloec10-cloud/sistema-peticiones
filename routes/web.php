<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoAuthController;
use App\Http\Controllers\SecretariaAuthController;
use App\Http\Controllers\SolicitudExamenController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\SecretariaCalificacionesController;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rutas de Alumno
|--------------------------------------------------------------------------
*/
Route::prefix('alumno')->group(function () {

    // AUTH
    Route::get('login', [AlumnoAuthController::class, 'showLoginForm'])->name('alumno.login');
    Route::post('login', [AlumnoAuthController::class, 'login'])->name('alumno.login.post');
    Route::post('logout', [AlumnoAuthController::class, 'logout'])->name('alumno.logout');

    Route::get('register', [AlumnoAuthController::class, 'showRegisterForm'])->name('alumno.register');
    Route::post('register', [AlumnoAuthController::class, 'register'])->name('alumno.register.post');

    // DASHBOARD
    Route::get('dashboard', [AlumnoAuthController::class, 'dashboard'])->name('alumno.dashboard');

    // PDF
    Route::get('calendario', function () {
        return response()->file(public_path('pdf/calendario.pdf'));
    })->name('alumno.calendario');

    // EXÁMENES
    Route::get('solicitar-examen', [SolicitudExamenController::class,'index'])->name('alumno.solicitar');

    //  NUEVA RUTA CORRECTA (LA IMPORTANTE)
    Route::get('fechas-filtradas/{clave}/{etapa}', [SolicitudExamenController::class,'fechasFiltradas']);

    //  ELIMINADAS (YA NO SE USAN)
    // Route::get('modulos-por-etapa/{etapa}', [SolicitudExamenController::class,'modulosPorEtapa']);
    // Route::get('fechas/{moduloId}', [SolicitudExamenController::class,'fechas']);

    Route::post('guardar-examen',[SolicitudExamenController::class,'guardar'])->name('alumno.examen.guardar');

    Route::get('mis-examenes',[SolicitudExamenController::class,'misExamenes'])->name('alumno.mis_examenes');

    Route::get('resultados-examenes', [SolicitudExamenController::class, 'resultados'])
        ->name('alumno.resultados.examenes');
});

/*
|--------------------------------------------------------------------------
| Rutas de Secretaria
|--------------------------------------------------------------------------
*/
Route::prefix('secretaria')->group(function () {

    // AUTH
    Route::get('login', [SecretariaAuthController::class, 'showLoginForm'])->name('secretaria.login');
    Route::post('login', [SecretariaAuthController::class, 'login'])->name('secretaria.login.post');
    Route::post('logout', [SecretariaAuthController::class, 'logout'])->name('secretaria.logout');

    // REGISTRO
    Route::get('registro', [SecretariaController::class, 'create'])->name('secretaria.register');
    Route::post('registro', [SecretariaController::class, 'store'])->name('secretaria.register.post');

    // DASHBOARD
    Route::get('dashboard', [SecretariaController::class, 'dashboard'])->name('secretaria.dashboard');

    // CALIFICACIONES
    Route::get('calificaciones', [SecretariaCalificacionesController::class, 'index'])
        ->name('secretaria.calificaciones');

    Route::post('calificaciones/guardar',[SecretariaCalificacionesController::class,'guardar'])
        ->name('secretaria.calificaciones.guardar');

    Route::put('calificacion/editar/{id}', [SecretariaCalificacionesController::class, 'editar'])
        ->name('secretaria.calificacion.editar');

    // ALUMNOS
    Route::resource('alumnos', AlumnoController::class)->names([
        'index' => 'secretaria.alumnos.index',
        'create' => 'secretaria.alumnos.create',
        'store' => 'secretaria.alumnos.store',
        'show' => 'secretaria.alumnos.show',
        'edit' => 'secretaria.alumnos.edit',
        'update' => 'secretaria.alumnos.update',
        'destroy' => 'secretaria.alumnos.destroy',
    ]);
});