<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Route::resource('point-presences', \App\Http\Controllers\PointPresenceController::class);
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('point-presences')->controller(\App\Http\Controllers\PointPresenceController::class)->name('point-presences.')->group(function () {
         Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        // Route::get('/{id}', 'show')->name('show');
        
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

});
