<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Dashboard\HistoryLogController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Developer\RoleController;
use App\Http\Controllers\Example\IndexController as ExampleIndexController;
use Illuminate\Support\Facades\Route;

/**
 * Rutas generales/publicas
 * 
 * Rutas accesibles por todos los usuarios y no usuarios
 */
Route::redirect('/', '/login');

/**
 * Rutas del Dashboard
 * 
 * El dashboard es el panel de los usuarios de forma general
 */
Route::prefix('dashboard')->name('dashboard.')->middleware([
    'auth:sanctum',
    'verified',
    config('jetstream.auth_session')
])->group(function () {
    Route::get('/welcome', [IndexController::class, 'index'])->name('index');
    Route::inertia('/changelogs', 'Dashboard/Changelogs')->name('changelogs');
    Route::inertia('/help', 'Dashboard/Help')->name('help');

    # Log de Acciones
    Route::resource('histories', HistoryLogController::class)->only([
        'index',
        'store'
    ]);

    Route::resource('notifications', NotificationController::class);
    Route::prefix('/users')->name('users.')->group(function()
    {
        Route::get('/notifications', [UserController::class, 'getNotifications'])->name('notifications');
    });
});

/**
 * Rutas de administrador
 * 
 * Estas ubicaciones son del administrador, sin embargo el desarrollador
 * puede acceder a ellas.
 */
Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session')
])->group(function () {
    Route::resource('users', UserController::class);

    Route::prefix('/users')->name('users.')->group(function()
    {
        Route::get('{user}/settings', [UserController::class, 'settings'])->name('settings');
        Route::post('/password', [UserController::class, 'updatePassword'])->name('password');
        Route::post('/syncRoles', [UserController::class, 'syncRoles'])->name('syncRoles');
    });
});

/**
 * Rutas solo del desarrollador
 * 
 * Son ubicaciones o funciones que pueden llegar a ser muy sensibles en el sistema, por lo que
 * solo el desarrollador debe de ser capaz de modificarlas o actualizarlas.
 */
Route::prefix('developer')->name('developer.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session')
])->group(function () {
    Route::resource('roles', RoleController::class);
});

/**
 * Elementos de la plantilla
 * 
 * Estos son elementos que existen y pueden ser usados en la plantilla, vienen ejemplos de uso.
 * 
 * Estas rutas pueden ser comentadas o eliminadas cuando se finalice un proyecto. Por default estan ocultas
 * en el dashboard.
 */
Route::prefix('examples')->name('examples.')->middleware([
    'auth:sanctum',
    'verified',
    config('jetstream.auth_session')
])->group(function () {
    Route::get('/', [ExampleIndexController::class, 'index'])->name('index');
});