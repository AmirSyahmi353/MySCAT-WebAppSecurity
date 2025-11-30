<?php

namespace App\Http\Controllers\Dietitian;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Result;

class DashboardController extends Controller
{
    public function index()
    {
        // Count all patients
        $totalPatients = User::where('role', 'patient')->count();

        // Correct craving analytics based on totalScore
        $normalCount = Result::where('totalScore', '<=', 45)->count();
        $highCount   = Result::where('totalScore', '>=', 46)->count();

        return view('admin.dashboard', compact(
            'totalPatients',
            'normalCount',
            'highCount'
        ));
    }
}
