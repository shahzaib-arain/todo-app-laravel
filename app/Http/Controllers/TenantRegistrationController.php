<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stancl\Tenancy\Tenant;

class TenantRegistrationController extends Controller
{
    public function create()
    {
        return view('tenant.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha_dash|unique:tenants,id', // tenant name is the subdomain
        ]);

        // Create tenant and its DB
        $tenant = Tenant::create([
            'id' => $request->name,
        ]);

        $tenant->domains()->create([
            'domain' => $request->name . '.localhost', // You can customize domain logic
        ]);

        return redirect()->back()->with('success', 'Tenant registered: ' . $tenant->id);
    }
}
