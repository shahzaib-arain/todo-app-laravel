<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantRegistrationController;
use App\Http\Controllers\CentralAdminController;

foreach (config('tenancy.central_domains', []) as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome'); // Home page or tenant creation page
        });

        // Public routes
        Route::get('/register-tenant', [TenantRegistrationController::class, 'create'])->name('tenant.register');
        Route::post('/register-tenant', [TenantRegistrationController::class, 'store'])->name('tenant.store'); 
        
        // 🔒 Auth-protected routes for super admin
       Route::middleware(['auth', 'isAdmin'])->prefix('super-admin')->group(function () {
    Route::get('/tenants', [CentralAdminController::class, 'index'])->name('superadmin.tenants');
});


        // Auth scaffolding routes (login, register, etc.)
        require __DIR__.'/auth.php';
    });
}
