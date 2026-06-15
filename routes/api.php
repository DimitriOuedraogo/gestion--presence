<?php

use App\Http\Controllers\Api\PointageController;
use Illuminate\Support\Facades\Route;

Route::post('/pointage', [PointageController::class, 'store']);