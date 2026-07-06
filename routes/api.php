<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\DealController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\FollowUpController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ExpenseController;

// Auth
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Companies
    Route::apiResource('companies', CompanyController::class);
    Route::patch('/companies/{id}/toggle-status', [CompanyController::class, 'toggleStatus']);

    // Clients
    Route::apiResource('clients', ClientController::class);

    // Leads
    Route::apiResource('leads', LeadController::class);
    Route::patch('/leads/{id}/status', [LeadController::class, 'updateStatus']);

    // Services
    Route::apiResource('services', ServiceController::class);

    // Deals
    Route::apiResource('deals', DealController::class);
    Route::get('/deals/stats', [DealController::class, 'stats']);

    // Expenses
    Route::apiResource('expenses', ExpenseController::class);

    // Payments
    Route::apiResource('payments', PaymentController::class);
    Route::get('/payments/stats', [PaymentController::class, 'stats']);

    // FollowUps
    Route::apiResource('follow-ups', FollowUpController::class);

    // Activities
    Route::apiResource('activities', ActivityController::class);

    // Users
    Route::apiResource('users', UserController::class);
});
