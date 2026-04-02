<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ReportController;

// Rutas públicas
Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
});

// Rutas protegidas
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me',      [AuthController::class, 'me']);

    // Solo admin puede gestionar empleados
    Route::apiResource('employees', EmployeeController::class)->middleware('role:admin');

    // Tareas
    Route::apiResource('tasks', TaskController::class);

    // Reportes
    Route::get('reports/pdf', [ReportController::class, 'pdf']);
});
