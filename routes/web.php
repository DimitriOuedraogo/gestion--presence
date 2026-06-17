<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresenceController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return view('index');
})->name('home');

Route::prefix('presences')->controller(PresenceController::class)->name('presences.')->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/create', 'create')->name('create');

    Route::get('/{id}/edit', 'edit')->name('edit');

    Route::post('/', 'store')->name('store');
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

    Route::prefix('session-presences')->controller(\App\Http\Controllers\SessionPresenceController::class)->name('session-presences.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        // Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

});
