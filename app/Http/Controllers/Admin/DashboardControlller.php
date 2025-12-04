<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
{
    // Prevent ADMIN from accessing dashboard
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dietitianindex');
    }

    // Count patients (dietitian)
    $totalPatients = User::where('role', 'patient')->count();

    return view('admin.dashboard', compact('totalPatients'));
}
}
