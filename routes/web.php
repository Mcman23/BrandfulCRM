<?php
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\CompanyController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\LeadController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\SalesController;
use App\Http\Controllers\Web\FollowUpController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\SettingsController;
use App\Http\Controllers\Web\CompanyFilterController;
use App\Http\Controllers\Web\ExpenseController;

// Health check endpoint for Railway
Route::get('/up', function () {
    return response()->json(['status' => 'ok'], 200);
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Company filter
Route::post('/company-filter', [CompanyFilterController::class, 'set'])->name('company.filter');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Companies
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
    Route::post('/companies', [CompanyController::class, 'store']);
    Route::put('/companies/{id}', [CompanyController::class, 'update']);
    Route::patch('/companies/{id}/toggle-status', [CompanyController::class, 'toggleStatus']);
    Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::post('/clients', [ClientController::class, 'store']);
    Route::put('/clients/{id}', [ClientController::class, 'update']);
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

    // Pipeline
    Route::get('/pipeline', [LeadController::class, 'index'])->name('pipeline');
    Route::post('/pipeline', [LeadController::class, 'store']);
    Route::patch('/pipeline/{id}/status', [LeadController::class, 'updateStatus']);
    Route::delete('/pipeline/{id}', [LeadController::class, 'destroy']);

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

    // Sales
    Route::get('/sales', [SalesController::class, 'index'])->name('sales');

    // Expenses
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses');
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);

    // Follow-ups
    Route::get('/follow-ups', [FollowUpController::class, 'index'])->name('follow-ups');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
});


// Theme toggle
Route::get('/toggle-theme', function() {
    session(['theme' => session('theme') === 'dark' ? 'light' : 'dark']);
    return response()->noContent();
})->name('toggle.theme');
