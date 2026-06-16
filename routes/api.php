<?php

use App\Http\Controllers\Api\PointageController;
use App\Http\Controllers\Api\SessionActiveController;
use Illuminate\Support\Facades\Route;

Route::get('/session-active', [SessionActiveController::class, 'index']);
Route::post('/pointage', [PointageController::class, 'store']);