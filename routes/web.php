<?php

use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/**
 * Rutas
 */

Route::redirect('/', '/login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    # Historial de cambios en el software
    Route::get('/changelogs', function() { 
        return inertia('Changelogs'); 
    })->name('changelogs.index');
    
    # Ayuda para el usuario
    Route::get('/help', function() { 
        return inertia('Help'); 
    })->name('help.index');

    # Recursos externos consultables
    Route::prefix('resources')->name('resources.')->group(function(){
       Route::get('/rolesByUser/{user}', [ResourceController::class, 'rolesByUser'])->name('rolesByUser');
    });

    # Log de Acciones
    Route::resource('histories', HistoryLogController::class)
    ->only([
        'index',
        'store'
    ]);

    # Notificaciones
    Route::resource('notifications', NotificationController::class);
    Route::prefix('/users')->name('users.')->group(function()
    {
        Route::get('/notifications', [UserController::class, 'getNotifications'])->name('notifications');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'role:admin|developer'
])->group(function () {
    Route::resource('users', UserController::class);
    Route::prefix('/users')->name('users.')->group(function()
    {
        Route::get('{user}/settings', [UserController::class, 'settings'])->name('settings');
        Route::post('/password', [UserController::class, 'updatePassword'])->name('password');
        Route::post('/syncRoles', [UserController::class, 'syncRoles'])->name('syncRoles');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'role:developer'
])->group(function () {
    Route::resource('roles', RoleController::class);
});
