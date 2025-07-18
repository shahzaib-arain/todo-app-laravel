<?php

use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains', []) as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome'); // Home page or tenant creation page
        });

        require __DIR__.'/auth.php'; // Only if you want central auth
    });
}
