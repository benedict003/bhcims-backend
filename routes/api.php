<?php


use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ResidentController;
use App\Http\Controllers\API\ConsultationController;
use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\MedicineController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\UserController;




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

 
    

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);

    Route::post('/logout', [AuthController::class, 'logout']);

    
    Route::get('/doctors', [UserController::class, 'doctors']);
    Route::apiResource('/appointments', AppointmentController::class);

    Route::apiResource('residents', ResidentController::class);

    Route::apiResource('consultations', ConsultationController::class);

    Route::apiResource('appointments', AppointmentController::class);

    Route::apiResource('medicines', MedicineController::class);

    Route::apiResource('reports', ReportController::class);

    Route::get('/dashboard/stats', [
        DashboardController::class,
        'stats'
    ]);
});