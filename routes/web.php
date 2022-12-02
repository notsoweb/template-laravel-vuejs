<?php

use App\Http\Controllers\HistoryLogController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
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

    # Log de Acciones
    Route::resource('histories', HistoryLogController::class)
    ->only([
        'index',
        'store'
    ]);
});

