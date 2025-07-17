<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        return redirect()->route('dashboard.' . strtolower($role));
    }

    public function admin()
    {
        return view('dashboard.admin');
    }

    public function user()
    {
        return view('dashboard.user');
    }

    public function pm()
    {
        return view('dashboard.pm');
    }

    public function viewer()
    {
        return view('dashboard.viewer');
    }
}
