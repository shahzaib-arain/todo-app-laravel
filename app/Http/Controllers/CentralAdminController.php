<?php

namespace App\Http\Controllers;

use App\Models\Tenant;

class CentralAdminController extends Controller
{
    public function index()
    {
        dd(auth()->user()); 
        // Eager load domains for each tenant
        $tenants = Tenant::with('domains')->get();

        return view('central.tenant.index', compact('tenants'));
    }
}
