<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Authenticated Routes
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Role-Based Dashboard Redirect
        Route::get('/dashboard', function () {
            $user = Auth::user();
            $role = $user?->role?->name;

            return match ($role) {
                'admin' => redirect()->route('dashboard.admin'),
                'pm' => redirect()->route('dashboard.pm'),
                'user' => redirect()->route('dashboard.user'),
                'viewer' => redirect()->route('dashboard.viewer'),
                default => abort(403, 'Unauthorized role'),
            };
        })->name('dashboard');

        // Task Routes
        Route::resource('tasks', TaskController::class);
    });

    // Admin Role Routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');

        // User Management (optional)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // PM Role Routes
    Route::middleware(['auth', 'role:pm'])->group(function () {
        Route::get('/dashboard/pm', [DashboardController::class, 'pm'])->name('dashboard.pm');
    });

    // User Role Routes
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('dashboard.user');
    });

    // Viewer Role Routes
    Route::middleware(['auth', 'role:viewer'])->group(function () {
        Route::get('/dashboard/viewer', [DashboardController::class, 'viewer'])->name('dashboard.viewer');
    });

    // Auth scaffolding
    require __DIR__.'/auth.php';
});
