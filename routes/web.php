<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegistroEventoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ClienteController; // Asegúrate de que este controlador exista
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\SucursalController;

use Illuminate\Support\Facades\Http; // Añade esta línea en la parte superior
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


// Rutas Públicas
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/nuestra_empresa', function () {
    return view('nuestra');
});
Route::get('/sucursales', function () {
    return view('sucursales');
});
Route::get('/ferresur_en_accion', function () {
    return view('ferresur_en_accion');
});
Route::get('/ventas_mayoreo', function () {
    return view('ventas_mayoreo');
});
Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/obra_negra', function () {
    return view('obra_negra');
});
Route::get('/balconeria_herreria', function () {
    return view('balconeria_herreria');
});

Route::get('/lamina', function () {
    return view('lamina');
});

Route::get('/herramienta', function () {
    return view('herramienta');
});

Route::get('/impermeabilizante', function () {
    return view('impermeabilizante');
});

Route::get('plomeria_fontaneria', function () {
    return view('plomeria_fontaneria');
});

Route::get('para_el_campo', function () {
    return view('para_el_campo');
});

Route::post('/backup', [BackupController::class, 'create'])
    ->name('backup.create')
    ->middleware('auth');

// Rutas de Perfil (Autenticadas)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de Administrador (Autenticadas y con Rol de Administrador)<?php


// Rutas de Administrador (Autenticadas y con Rol de Administrador)
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/administrador/dashboard', [AdministradorController::class, 'dashboard'])->name('administrador.dashboard');
    Route::get('/administrador/empleados', [EmpleadoController::class, 'index'])->name('administrador.empleados.index'); // Cambio aquí
    Route::get('/administrador/empleados/{id_empleado}/edit', [EmpleadoController::class, 'edit'])->name('administrador.empleados.edit');


    Route::get('/productos/reporte', [ProductoController::class, 'generarReporte'])->name('productos.reporte');
    Route::get('/eventos/reporte', [EventoController::class, 'generarReporte'])->name('eventos.reporte');
    Route::get('/empleados/reporte', [EmpleadoController::class, 'generarReporte'])->name('empleados.reporte');
    Route::get('/clientes/reporte', [ClienteController::class, 'generarReporte'])->name('clientes.reporte');
    Route::get('/eventos/historial/reporte', [EventoController::class, 'generarReporteHistorial'])->name('eventos.historial.reporte');
    Route::get('/administrador/perfil', [AdministradorController::class, 'edit'])->name('administrador.perfil.edit');
    Route::put('/administrador/perfil', [AdministradorController::class, 'update'])->name('administrador.perfil.update');
    Route::get('/administrador/download', [AdministradorController::class, 'download'])->name('administrador.download');


    Route::get('/eventos/historial-cliente/reporte', [EventoController::class, 'generarReporteHistorialCliente'])->name('eventos.historial-cliente.reporte');

    // Asegúrate de tener esta ruta definida
    Route::get('/eventos/{evento}/pdf', [EventoController::class, 'downloadPdf'])->name('eventos.pdf');


    Route::resource('empleados', EmpleadoController::class)->names([
        'create' => 'administrador.empleados.create', // Cambio aquí
        'store' => 'administrador.empleados.store', // Cambio aquí
        'update' => 'administrador.empleados.update', // Cambio aquí
        'destroy' => 'administrador.empleados.destroy', // Cambio aquí
    ]);

    Route::resource('users', UserController::class)->names([
        'index' => 'administrador.users.index',
        'create' => 'administrador.users.create',
        'edit' => 'administrador.users.edit',
        'store' => 'administrador.users.store',
        'update' => 'administrador.users.update',
        'destroy' => 'administrador.users.destroy',
    ]);

    Route::resource('productos', ProductoController::class)->names([
        'index' => 'administrador.productos.index',
        'create' => 'administrador.productos.create',
        'edit' => 'administrador.productos.edit',
        'store' => 'administrador.productos.store',
        'update' => 'administrador.productos.update',
        'destroy' => 'administrador.productos.destroy',
    ]);

    Route::resource('eventos', EventoController::class)->names([
        'index' => 'administrador.eventos.index',
        'create' => 'administrador.eventos.create',
        'store' => 'administrador.eventos.store',
        'edit' => 'administrador.eventos.edit',
        'update' => 'administrador.eventos.update',
        'destroy' => 'administrador.eventos.destroy',
    ]);


    Route::resource('registros', RegistroEventoController::class)->names([
        'index' => 'administrador.registros.index',
        'create' => 'administrador.registros.create',
        'store' => 'administrador.registros.store',
        'edit' => 'administrador.registros.edit',
        'update' => 'administrador.registros.update',
        'destroy' => 'administrador.registros.destroy',
    ]);

    // Rutas para Sucursales
    Route::get('/sucursales', [SucursalController::class, 'index'])->name('administrador.sucursales.index');
    Route::get('/sucursales/create', [SucursalController::class, 'create'])->name('administrador.sucursales.create');
    Route::post('/sucursales', [SucursalController::class, 'store'])->name('administrador.sucursales.store');
    Route::get('/sucursales/{sucursal}/edit', [SucursalController::class, 'edit'])->name('administrador.sucursales.edit');
    Route::put('/sucursales/{sucursal}', [SucursalController::class, 'update'])->name('administrador.sucursales.update');
    Route::delete('/sucursales/{sucursal}', [SucursalController::class, 'destroy'])->name('administrador.sucursales.destroy');


    // CRUD de Clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('administrador.clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('administrador.clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('administrador.clientes.store');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('administrador.clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('administrador.clientes.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('administrador.clientes.destroy');

    Route::get('/administrador/eventos/historial', [EventoController::class, 'historial'])
        ->name('administrador.eventos.historial');
    Route::get('/productos/reporte', [ProductoController::class, 'generarReporte'])->name('productos.reporte');
});


// Asegúrate de tener un middleware 'admin'
// Rutas de Empleado (Autenticadas y con Rol de Empleado)// Rutas de Empleado (Autenticadas y con Rol de Empleado)

// Rutas de Empleado (Autenticadas y con Rol de Empleado)// Rutas de Empleado (Autenticadas y con Rol de Empleado)
Route::middleware(['auth', 'role:empleado'])->group(function () {
    Route::get('/empleado/dashboard', [EmpleadoController::class, 'dashboard'])->name('empleado.dashboard');
    Route::get('/empleado/download', [EmpleadoController::class, 'download'])->name('empleado.download');
    Route::get('/empleado/perfil', [EmpleadoController::class, 'edit'])->name('empleado.perfil.edit');
    Route::put('/empleado/perfil', [EmpleadoController::class, 'update'])->name('empleado.perfil.update');

    Route::get('/empleado/eventos', [EventoController::class, 'index'])->name('empleado.eventos.index');
    Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');
    Route::get('/eventos/{evento}/registrar', [RegistroEventoController::class, 'create'])->name('eventos.registrar');
    Route::post('/evento/registrar/{eventoId}', [RegistroEventoController::class, 'registrarEvento'])->name('registro-evento');
    Route::post('/eventos/{eventoId}/cancelar', [RegistroEventoController::class, 'cancelarRegistro'])
        ->name('registro-evento.cancelar');

    // Agregar esta ruta para el historial de eventos del empleado
    Route::get('/empleado/eventos/historial', [EventoController::class, 'historialEventosEmpleado'])
        ->name('empleado.eventos.historial');
});

// Rutas Protegidas para Clientes Autenticados
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');
    Route::get('/cliente/eventos', [EventoController::class, 'index'])->name('cliente.eventos.index');
    Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');
    Route::get('/eventos/{evento}/registrar', [RegistroEventoController::class, 'create'])->name('eventos.registrar');
    Route::post('/evento/registrar/{eventoId}', [RegistroEventoController::class, 'registrarEvento'])->name('registro-evento');
    Route::post('/eventos/{eventoId}/cancelar', [RegistroEventoController::class, 'cancelarRegistro'])
        ->name('registro-evento.cancelar');
    Route::get('/cliente/perfil/editar', [ClienteController::class, 'editar'])->name('cliente.perfil.editar');
    Route::put('/cliente/perfil/actualizar', [ClienteController::class, 'actualizarPerfil'])->name('cliente.perfil.actualizar');

    //Route::get('/evento/{eventoId}', [RegistroEventoController::class, 'mostrarEvento'])->name('mostrar-evento');
    Route::get('/evento/historial', [EventoController::class, 'historialEventosCliente'])->name('cliente.eventos.historial');
});


require __DIR__ . '/auth.php';
