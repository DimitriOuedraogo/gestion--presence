<?php

use App\Http\Controllers\PresencePubliqueController;
use Illuminate\Support\Facades\Route;

// Routes publiques de marquage de présence (sans authentification)
Route::get('/presence/{token}', [PresencePubliqueController::class, 'afficher'])->name('presence.publique.afficher');
Route::post('/presence/{token}', [PresencePubliqueController::class, 'valider'])->name('presence.publique.valider');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

// Auth admin
Route::get('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('index');

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('agents')->controller(\App\Http\Controllers\AgentController::class)->name('agents.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::prefix('point-presences')->controller(\App\Http\Controllers\PointPresenceController::class)->name('point-presences.')->group(function () {
         Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        // Route::get('/{id}', 'show')->name('show');
        
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('session-presences')->controller(\App\Http\Controllers\SessionPresenceController::class)->name('session-presences.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/regenerer-qr', 'regenererQrCodes')->name('regenerer-qr');
        Route::get('/{id}/presences', 'presences')->name('presences');
        Route::get('/{id}/presences/export', 'exportPresences')->name('presences.export');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

});
