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
        // Count all patients using role from users collection
        $totalPatients = User::where('role', 'patient')->count();

        return view('admin.dashboard', compact('totalPatients'));
    }
}
